<?php

namespace App\Models;
use App\Models\User;
use App\Models\ApprovalProgress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BadgeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'demandeur_nom',
        'demandeur_prenom',
        'demandeur_directeur',
        'demandeur_fonction',
        'demandeur_telephone',
        'demandeur_matricule',
        'date',
        'beneficiaire_nom',
        'beneficiaire_prenom',
        'beneficiaire_direction',
        'beneficiaire_fonction',
        'beneficiaire_telephone',
        'beneficiaire_employeur',
        'beneficiaire_matricule',
        'categorie_badge',
        'date_debut',
        'date_fin',
        'motivation',
        'upload',
        'user_id',
    ];

    public function user(){ 
        return $this->belongsTo(User::class);
    }

    public function approvalProgress(){
        return $this->hasMany(ApprovalProgress::class);
    }
}
