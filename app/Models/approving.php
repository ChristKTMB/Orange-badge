<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class approving extends Model
{
    use HasFactory;
    protected $table = '';
    protected $fillable = [
        'name',
        'approving'
    ];

}
