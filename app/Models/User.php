<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\approving;
use App\Models\BadgeRequest;
use App\Models\ApprovalProgress;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function badgeRequests(){
        return $this->hasMany(BadgeRequest::class);
    }

    public function approvalProgress(){
        return $this->hasMany(ApprovalProgress::class);
    }

    public function isApprover(){
        return approving::where('email', $this->email)->exists();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'username',
        'email',
        'role',
        'phone',
        'password',
        'direction',
        'fonction',
        'matricule',
        'manager',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
