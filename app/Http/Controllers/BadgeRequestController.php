<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use App\Models\Approving;
use App\Models\BadgeRequest;
use Illuminate\Http\Request;
use App\Models\ApprovalProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Filesystem\Filesystem;
use App\Http\Controllers\ApproveController;
use App\Notifications\ApprovalNotification;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\View\Factory as ViewFactory;

class BadgeRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $user = Auth::user();
        $badgeRequests = ApprovalProgress::where("demandeur_id", $user->id)
            ->where("approver_id", null)
            ->with('badgeRequest')
            ->orderBy('created_at', 'desc')
            ->get();

        return view("badge.history",compact("badgeRequests"));
    }

    public function store(Request $request){
        
        $data = $request->validate([
             'demandeur_nom' => 'required',
             'demandeur_prenom' => 'required',
             'demandeur_directeur' => 'required',
             'demandeur_fonction' => 'required',
             'demandeur_telephone' => 'required',
             'demandeur_matricule' => 'required',
             'date' => 'required|date',
             'beneficiaire_nom' => 'required',
             'beneficiaire_prenom' => 'required',
             'beneficiaire_direction' => 'required',
             'beneficiaire_fonction' => 'required',
             'beneficiaire_telephone' => 'required',
             'beneficiaire_employeur' => 'required',
             'beneficiaire_matricule' => 'required',
             'categorie_badge' => 'required',
             'date_debut' => 'required|date',
             'date_fin' => 'required|date',
             'motivation' => 'required',
             'upload' => 'nullable|mimes:jpeg,png,pdf|max:2048',
             'user_id',
        ]);
        
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $path = $file->store('uploads', 'public');
        } else {
            $path = null;
        }

        $categorie = $request->typeDemande;
        $approvers = Approving::pluck('id', 'name', 'fonction', 'email');
        
        $approversData = json_encode($approvers);

    
        $badgeRequest = new BadgeRequest($data);
        $badgeRequest->approvers = $approversData;
        $badgeRequest->categorie = $categorie;
        $badgeRequest->upload = $path;
        $user = Auth::user();
        $badgeRequest->user()->associate($user);
        $badgeRequest->save();

         // Insertion des données dans la table de liaison "approvals_progress"
        $approvalsProgress = new ApprovalProgress();
        $approvalsProgress->demandeur_id = Auth::user()->id; // ID de l'utilisateur connecté
        $approvalsProgress->badge_request_id = $badgeRequest->id; // ID du formulaire nouvellement créé
        $approvalsProgress->total_approvers = Approving::where('etat', 1)->count() + 1; // Nombre total d'approbateurs
        $approvalsProgress->step = 1; // L'utilisateur initiateur doit approuver en premier
        $approvalsProgress->approved = false; // Le formulaire n'est pas encore approuvé
        $approvalsProgress->approval_date = now();
        $approvalsProgress->save();

        $approve = new ApproveController();
        $id = $badgeRequest->id;
        $appouver = $approve->approve($request, $id);

        return redirect()->route('badge.index');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function show(int $badgeRequest){
        $approval = ApprovalProgress::where('badge_request_id', $badgeRequest)
                ->first();
        $badgeRequest = $approval->badgeRequest;
        $approvers = Approving::all()->toArray();
        $approved = $approval->approved == 1 ? true : false;
        $motif = $approval->motif;
        

        return view('badge.formdetail',compact("badgeRequest", "approved","approvers","motif"));
    }

    public function showBadge() {
        $badgeRequest = BadgeRequest::all();
        return view('index', compact('badgeRequest'));
    }

    public function createPDF() {
        // Récupère les demandes de badge de l'utilisateur authentifié
        $badgeRequest = BadgeRequest::where('user_id', Auth::user()->id)->get();
        
        // Convertit le résultat en array
        $badgeRequestArray = $badgeRequest->toArray();
        
        // Passe l'array à la vue Blade index
        $html = view('index', ['badgeRequest' => $badgeRequestArray])->render();
        
        // Utilise Dompdf pour convertir le HTML en PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        
        // Récupère les objets Config, Filesystem et ViewFactory
        $config = app(Config::class);
        $filesystem = app(Filesystem::class);
        $view = app(ViewFactory::class);
        
        // Encapsule Dompdf dans une classe helper PDF
        $pdf = new PDF($dompdf, $config, $filesystem, $view);
      
        // Renvoie le PDF au téléchargement
//    echo $html;
//    die();

     return $pdf->download('badge_request.pdf');
       
    }
}


