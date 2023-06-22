<?php

namespace App\Models;

use App\Models\User;
use App\Models\approving;
use App\Models\BadgeRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApprovalProgress extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'approvals_progress';

    protected $fillable = [
        'demandeur_id',
        'badge_request_id',
        'approver_id',
        'step',
        'total_approvers',
        'approved',
        'approval_date',
    ];

    public function user(){

        return $this->belongsTo(User::class, 'approver_id');
    }

    public function approver(){

        return $this->belongsTo(approving::class, 'approver_id');
    }

    public function badgeRequest(){

        return $this->belongsTo(BadgeRequest::class);
    }
}
