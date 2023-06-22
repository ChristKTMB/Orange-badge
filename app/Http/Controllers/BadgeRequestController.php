<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BadgeRequest;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem;
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
        return $pdf->download('badge_request.pdf');
    }
}