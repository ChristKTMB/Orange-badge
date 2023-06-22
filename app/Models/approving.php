<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Approving extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'approving';

    protected $fillable = [
        'name',
        'fonction',
        'email'
    ];
    
    public function routeNoticationForMail(){
        return $this->email;
    }
}
