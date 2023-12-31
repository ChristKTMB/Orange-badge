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

    public function index()
    {

        $user = Auth::user();
        $badgeRequests = BadgeRequest::where("user_id", $user->id)
            ->orderBy('created_at', 'desc')->paginate(9);

        return view("badge.history", compact("badgeRequests"));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'beneficiaire_nom' => 'required',
            'beneficiaire_prenom' => 'required',
            'beneficiaire_telephone' => 'required',
            'beneficiaire_direction' => 'nullable',
            'beneficiaire_fonction' => 'nullable',
            'beneficiaire_employeur' => 'nullable',
            'beneficiaire_matricule' => 'nullable',
            'motivation' => 'nullable',
            'categorie_badge' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
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
        $approvers = Approving::where('etat', 1)
            ->select('id', 'name', 'fonction', 'email')
            ->get();
        $approversData = json_encode($approvers);

        $badgeRequest = new BadgeRequest($data);
        $badgeRequest->demandeur_nom = $user->name;
        $badgeRequest->demandeur_prenom = $user->first_name;
        $badgeRequest->demandeur_directeur = $request->demandeur_directeur;
        $badgeRequest->demandeur_fonction = $user->fonction;
        $badgeRequest->demandeur_telephone = $user->phone;
        $badgeRequest->demandeur_matricule = $user->matricule;
        $badgeRequest->date = now();
        $badgeRequest->approvers = $approversData;
        $badgeRequest->categorie = $categorie;
        $badgeRequest->upload = $path;
        $user = Auth::user();
        $badgeRequest->user()->associate($user);
        $badgeRequest->save();

        // Insertion des données dans la table de liaison "approvals_progress"
        $approvalsProgress = new ApprovalProgress();
        $approvalsProgress->demandeur_id = Auth::user()->id;
        $approvalsProgress->badge_request_id = $badgeRequest->id;
        $approvalsProgress->total_approvers = Approving::where('etat', 1)->count() + 1;
        if ($badgeRequest->categorie_badge == 'CONSULTANT' || $badgeRequest->categorie_badge == 'VISITEUR') {
            $approvalsProgress->total_approvers = Approving::where('etat', 1)->count();
        }
        $approvalsProgress->step = 1;
        $approvalsProgress->approved = false;
        $approvalsProgress->approval_date = now();
        $approvalsProgress->save();

        $approve = new ApproveController();
        $id = $badgeRequest->id;
        $appouver = $approve->approve($request, $id);

        return redirect()->route('badge.index');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function show(int $badgeRequest)
    {
        $approval = ApprovalProgress::where('badge_request_id', $badgeRequest)
            ->with('badgeRequest')
            ->first();

        if (!$approval) {
            return response()->view('erreur.error404', [], 404);
        }
        
        if (auth()->user()->id == $approval->demandeur_id || auth()->user()->role == 'admin') {
            $badgeRequest = $approval->badgeRequest;
            $approvers = json_decode($badgeRequest->approvers, true);
            $approved = $approval->approved == 1;
            $motif = $approval->motif;

            return view('badge.formdetail', compact('badgeRequest', 'approved', 'approvers', 'motif'));
        } else {
            return response()->view('erreur.error403', [], 403);
        }
    }


    public function showBadge()
    {
        $badgeRequest = BadgeRequest::all();
        return view('index', compact('badgeRequest'));
    }

    public function createPDF(BadgeRequest $badgeRequest)
    {
        $approvers = json_decode($badgeRequest->approvers, true);

        // Passe les deux variables à la vue Blade index
        $html = view('index', [
            'badgeRequest' => $badgeRequest,
            'approvers' => $approvers,
        ])->render();

        // Utilise Dompdf pour convertir le HTML en PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // Récupère les objets Config, Filesystem et ViewFactory
        $config = app(Config::class);
        $filesystem = app(Filesystem::class);
        $view = app(ViewFactory::class);

        // Encapsule Dompdf dans une classe helper PDF
        $pdf = new PDF($dompdf, $config, $filesystem, $view);

        return $pdf->download('badge_request.pdf');

    }
}
