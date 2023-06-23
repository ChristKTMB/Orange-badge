<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\approving;
use Illuminate\Http\Request;
use App\Models\ApprovalProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ApprovalNotification;

class ApproveController extends Controller
{

    public function index(){

        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $demandeurForms = ApprovalProgress::where('demandeur_id', $userId)->with('badgeRequest')->get();

        $userApprover = approving::where('email', $userEmail)->first();

        $approverForms = [];
        
        if ($userApprover){
            $approverForms = ApprovalProgress::where('approver_id', $userApprover->id)
            ->with('badgeRequest')
            ->get(); 
        }

        $approvalForms = collect($approverForms)->concat($demandeurForms);
        
        return view('approbation.index', compact("approvalForms"));
    }
    
    public function approve(Request $request, $id){

        // Recherche de l'approbation en fonction de l'ID du formulaire
        $approval = ApprovalProgress::findOrFail($id);

        // Récupération de la dernière entrée liée au formulaire concerné
        $lastAprroval = ApprovalProgress::where('badge_request_id', $approval->badge_request_id)
            ->orderBy('id', 'desc')
            ->first();

        $lastAprroval->approved = true;
        $lastAprroval->approval_date = Carbon::now();
        $lastAprroval->save();

        $nextStep = $lastAprroval->step + 1;
        $nextApprover_id = $lastAprroval->approver_id + 1;

        if ($nextStep <= $approval->total_approvers) {
            
            $nextApprover = approving::find($nextApprover_id);

            $nextApproval = new ApprovalProgress();
            $nextApproval->demandeur_id = $approval->demandeur_id;
            $nextApproval->badge_request_id = $approval->badge_request_id;
            $nextApproval->approver_id = $nextApprover->id;
            $nextApproval->step = $nextStep;
            $nextApproval->total_approvers = $approval->total_approvers;
            $nextApproval->approved = false;
            $nextApproval->approval_date = Carbon::now();
            $nextApproval->save();

            $nextApprover->notify(new ApprovalNotification());
        }

        return redirect()->route('approbation.index');
    }

    public function show($badgeRequestId){

        $approval = ApprovalProgress::where('badge_request_id', $badgeRequestId)->firstOrFail();
        $badgeRequest = $approval->badgeRequest;

        return view('approbation.show', compact("badgeRequest"));
    }

}
