<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use App\Models\approving;
use App\Models\BadgeRequest;
use Illuminate\Http\Request;
use App\Models\ApprovalProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Filesystem\Filesystem;
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
        $user = Auth::user()->id;
        $badgeRequest = BadgeRequest::all()->where("user_id",$user);
    
        return view("history",compact("badgeRequest"));
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
             'user_id',
        ]);

        $badgeRequest = new BadgeRequest($data);
        $user = Auth::user();
        $badgeRequest->user()->associate($user);
        $badgeRequest->save();

         // Insertion des données dans la table de liaison "approvals_progress"
        $approvalsProgress = new ApprovalProgress();
        $approvalsProgress->demandeur_id = Auth::user()->id; // ID de l'utilisateur connecté
        $approvalsProgress->badge_request_id = $badgeRequest->id; // ID du formulaire nouvellement créé
        $approvalsProgress->total_approvers = approving::count() + 1; // Nombre total d'approbateurs
        $approvalsProgress->step = 1; // L'utilisateur initiateur doit approuver en premier
        $approvalsProgress->approved = false; // Le formulaire n'est pas encore approuvé
        $approvalsProgress->approval_date = now();
        $approvalsProgress->save();

        return redirect()->route('badge.index');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function show(int $badgeRequest){
        $badgeRequest = BadgeRequest::find($badgeRequest);

        return view('formdetail',compact("badgeRequest"));
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


