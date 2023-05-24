<?php

namespace App\Http\Controllers;

use App\Models\BadgeRequest;
use Illuminate\Http\Request;

class BadgeRequestController extends Controller
{
    /*
    public function create(){
        return view('formulaire');
    }
    */

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
        ]);

        BadgeRequest::create($data);

        return redirect()->route('home')->with("success","votre demande de badge a été enregistrée");
    }
}
