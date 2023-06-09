<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Approving extends Model
{
    use HasFactory;
    protected $table = 'approving';
    protected $fillable = [
        'name',
        'fonction',
        'email'
    ];

}
