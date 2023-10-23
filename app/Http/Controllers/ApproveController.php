<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\approving;
use App\Mail\ApproverMail;
use Illuminate\Http\Request;
use App\Mail\ConfirmationMail;
use App\Models\ApprovalProgress;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApproveController extends Controller
{

    public function index(){

        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;

        //Recupere le premier id dans le groupe de donner capturer
        // $demandeurForms = ApprovalProgress::whereIn('id', function ($query){
        //     $query->selectRaw('MIN(id)')
        //         ->from('approvals_progress')
        //         ->groupBy('badge_request_id');
        // })
        //     ->where('demandeur_id',$userId)
        //     ->with('badgeRequest')
        //     ->get();
            
        $userApprover = approving::where('email', $userEmail)->where('etat', 1)->first();
        
        if ($userApprover){
            $approverForms = ApprovalProgress::where('approver_id', $userApprover->id)
                ->with('badgeRequest')
                ->get(); 
            $approvalForms = $approverForms;
        } else {
            //abort(404);
            $approvalForms = [];
        }
        
        return view('approbation.index', compact("approvalForms"));
    }
    public function rejete(Request $request, $id){
        // Recherche de l'approbation en fonction de l'ID du formulaire
        $approval = ApprovalProgress::where('badge_request_id', $id)
            ->orderBy('id', 'desc')
            ->first();
            $approval2 = ApprovalProgress::where('badge_request_id', $id)
            ->first();

        $approval->motif = $request->motif;
        $approval->approval_date = Carbon::now();
        $approval->save();

        $approval2->motif = $request->motif;
        $approval2->save();

        return redirect()->back();
    }

    public function approve(Request $request, $id){
      
        // Recherche de l'approbation en fonction de l'ID du formulaire
        $approval = ApprovalProgress::where('badge_request_id', $id)
            ->orderBy('id', 'desc')
            ->first();
        
        // Récupération de la dernière entrée liée au formulaire concerné
        $lastAprroval = ApprovalProgress::where('badge_request_id', $id)
            ->orderBy('id', 'desc')
            ->first();

        $lastAprroval->approved = true;
        $lastAprroval->approval_date = Carbon::now();
        $lastAprroval->save();

        $nextStep = $lastAprroval->step + 1;

        if($lastAprroval->approver_id == null) {
            $nextApprover_id = approving::where('etat', 1)->first()->id;
        }
        else {
            $nextApprover_id = approving::where('etat', 1)
            ->orderBy('id', 'desc')
            ->first()->id;
        }
        //$nextApprover_id = $lastAprroval->approver_id + 1;

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
            
            $nextApproverEmail = $nextApprover->email;
            $detailUrl = URL::route('approbation.show', $approval->badge_request_id);
            $email = new ApproverMail($detailUrl);
            Mail::to($nextApproverEmail)->send($email);
        }
        
        // Condition pour envoyer un mail au demandeur pour lui informer que sa demande a été validé
        if ($lastAprroval->step === $approval->total_approvers) {
            $demandeur = User::find($approval->demandeur_id);
            $demandeurEmail = $demandeur->email;
            $detailUrl = URL::route('approbation.show', $approval->badge_request_id);
            $email = new ConfirmationMail($detailUrl);
            Mail::to($demandeurEmail)->send($email);
        }
        if (!auth()->user()->isApprover()){
            return redirect()->route('badge.index'); 
        }
        return redirect()->route('approbation.index');
    }

    public function show($id){
        
        // Verifie si le user est connecté pour affichier le detail de la demande sinon il lui redirige vers la page de connexion
        if (auth()->check()) {
            // Verifie si l'utilisateur connecté est un approbateur
            $userApprover = approving::where('email', auth()->user()->email)->first();
            
            $approval = ApprovalProgress::where('badge_request_id', $id)
                ->first();
            $badgeRequest = $approval->badgeRequest;
            $approved = $approval->approved == 1 ? true : false;

            if ($userApprover) {
                // Récupérez l'entrée dans la table de liaison ou l'approbateur correspondant à user connecté est associé au formulaire
                $approval = ApprovalProgress::where('badge_request_id', $id)
                    ->where('approver_id', $userApprover->id)
                    ->first();
                if ($approval) {
                    $badgeRequest = $approval->badgeRequest;
                    $approved = $approval->approved == 1 ? true : false;
                    $motif = $approval->motif;
                }
            }

            return view('approbation.show', compact("badgeRequest","approved","motif"));
        } else {
            
            return redirect()->guest('login');
        } 
    }
}
