<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Approving;
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
        return Approving::where('email', $this->email)->where('etat', 1)->exists();
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class, 'direction_id');
    }

    public function delegues()
    {
        return $this->belongsToMany(User::class, 'interim', 'user_id','delegue')->withPivot('status','date_fin')->withTimestamps();
    }

    public function delegueActifs()
    {
        return $this->belongsToMany(User::class, 'interim', 'user_id','delegue')->wherePivot('status', 1);
    }

    public function interimaires()
    {
        return $this->belongsToMany(User::class, 'interim', 'delegue','user_id')->wherePivot('status', 1);
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
        'direction_id',
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
