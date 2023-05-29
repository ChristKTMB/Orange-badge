<?php

namespace App\Http\Controllers;

use App\Models\BadgeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BadgeRequestController extends Controller
{
    /*
    public function create(){
        return view('formulaire');
    }
    */
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
        
        return redirect()->route('home')->with("success","votre demande de badge a été enregistrée");
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function show(int $badgeRequest){
        $badgeRequest = BadgeRequest::find($badgeRequest);

        return view('formdetail',compact("badgeRequest"));
    }
}
