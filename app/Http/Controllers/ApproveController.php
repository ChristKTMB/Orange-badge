<?php

namespace App\Http\Controllers;

use App\Mail\RejectionNotification;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Approving;
use App\Mail\ApproverMail;
use Illuminate\Http\Request;
use App\Mail\ConfirmationMail;
use App\Models\ApprovalProgress;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApproveController extends Controller
{

    public function index()
    {

        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;

        $userApprover = Approving::where('email', $userEmail)->where('etat', 1)->first();

        if ($userApprover) {
            $approverForms = ApprovalProgress::where('approver_id', $userApprover->id)
                ->with('badgeRequest')
                ->orderBy('created_at', 'desc')
                ->paginate(9);
            $approvalForms = $approverForms;
        } else {
            //abort(404);
            $approvalForms = [];
        }

        return view('approbation.index', compact("approvalForms"));
    }

    public function approbationInterim()
    {
        $checkApprover = $this->checkInterim();

        if ($checkApprover) {

            $userId = $checkApprover->id;
            $userEmail = $checkApprover->email;

            $userApprover = Approving::where('email', $userEmail)->where('etat', 1)->first();

            if ($userApprover) {
                $approverForms = ApprovalProgress::where('approver_id', $userApprover->id)
                    ->with('badgeRequest')
                    ->orderBy('created_at', 'desc')
                    ->paginate(9);
                $approvalForms = $approverForms;
            } else {
                //abort(404);
                return abort(403);
            }

            return view('approbation.interimIndex', compact("approvalForms", "checkApprover"));
        } else {
            return response()->view('erreur.error404', [], 404);
        }
    }

    public function checkInterim()
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $checkApprover = $user->interimaires;
        if (count($checkApprover) > 0) {
            return $checkApprover->first();
        } else {
            return false;
        }
    }

    public function checkInterim2($userId)
    {
        $user = User::find($userId);
        $checkApprover = $user->interimaires;
        if (count($checkApprover) > 0) {
            return $checkApprover->first();
        } else {
            return false;
        }
    }

    public function rejete(Request $request, $id)
    {
        $checkApprover = $this->checkInterim();
        // Recherche de l'approbation en fonction de l'ID du formulaire
        $approval = ApprovalProgress::where('badge_request_id', $id)
            ->orderBy('id', 'desc')
            ->first();
        $approval2 = ApprovalProgress::where('badge_request_id', $id)
            ->first();

        if ($checkApprover) {
            $approval->interimaire = $checkApprover->id;
        }
        $approval->motif = $request->motif;
        $approval->approval_date = Carbon::now();
        $approval->save();

        $approval2->motif = $request->motif;
        $approval2->save();

        $demandeur = User::find($approval->demandeur_id);
        $demandeurEmail = $demandeur->email;

        $detailUrl = URL::route('badge.show', $approval->badge_request_id);
        $email = new RejectionNotification($detailUrl);
        Mail::to($demandeurEmail)->send($email);

        return redirect()->back();
    }

    public function approve(Request $request, $id)
    {

        $checkApprover = $this->checkInterim();
        // Recherche de l'approbation en fonction de l'ID du formulaire
        $approval = ApprovalProgress::where('badge_request_id', $id)
            ->orderBy('id', 'desc')
            ->first();

        // Récupération de la dernière entrée liée au formulaire concerné
        $lastAprroval = ApprovalProgress::where('badge_request_id', $id)
            ->orderBy('id', 'desc')->with('badgeRequest')
            ->first();

        if ($checkApprover) {
            $lastAprroval->interimaire = $checkApprover->id;
        }
        $lastAprroval->approved = true;
        $lastAprroval->approval_date = Carbon::now();
        $lastAprroval->save();

        $nextStep = $lastAprroval->step + 1;


        if ($lastAprroval->badgeRequest->categorie_badge == 'VISITEUR' || $lastAprroval->badgeRequest->categorie_badge == 'CONSULTANT') {
            $nextApprover_id = Approving::where('etat', 1)
                ->orderBy('id', 'desc')
                ->first()->id;
        } else {
            if ($lastAprroval->approver_id == null) {
                $nextApprover_id = Approving::where('etat', 1)->first()->id;
            } else {
                $nextApprover_id = Approving::where('etat', 1)
                    ->orderBy('id', 'desc')
                    ->first()->id;
            }
        }

        if ($nextStep <= $approval->total_approvers) {

            $nextApprover = Approving::find($nextApprover_id);

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

            $user2 = User::where("email", $nextApproverEmail)->first();

            $checkApprover2 = $user2->delegueActifs;
            if (count($checkApprover2) > 0) {
                $interimaire = $checkApprover2->first();
                $nextApproverEmail = $interimaire->email;
                $detailUrl = URL::route('approbation.single', $approval->badge_request_id);
                $email = new ApproverMail($detailUrl);
                Mail::to($nextApproverEmail)->send($email);
            }

        }

        // Condition pour envoyer un mail au demandeur pour lui informer que sa demande a été validé
        if ($lastAprroval->step === $approval->total_approvers) {
            $demandeur = User::find($approval->demandeur_id);
            $demandeurEmail = $demandeur->email;
            $detailUrl = URL::route('badge.show', $approval->badge_request_id);
            $email = new ConfirmationMail($detailUrl);
            Mail::to($demandeurEmail)->send($email);
        }
        if (!auth()->user()->isApprover()) {
            return redirect()->route('approbationInterim');
        }
        return redirect()->route('approbation.index');
    }

    public function show($id)
    {
        if (!auth()->check()) {
            return redirect()->guest('login');
        }

        $userApprover = Approving::where('email', auth()->user()->email)->first();

        if (!$userApprover) {
            return response()->view('erreur.error403', [], 403);
        }

        $approval = ApprovalProgress::where('badge_request_id', $id)
            ->where('approver_id', $userApprover->id)
            ->first();

        if (!$approval) {
            return response()->view('erreur.error404', [], 404);
        }

        $badgeRequest = $approval->badgeRequest;
        $approved = $approval->approved == 1;
        $motif = $approval->motif;

        return view('approbation.show', compact('badgeRequest', 'approved', 'motif'));
    }

    public function single($id)
    {
        if (!auth()->check()) {
            return redirect()->guest('login');
        }
        $checkApprover = $this->checkInterim();
        
        if ($checkApprover) {
            $userApprover = Approving::where('email', $checkApprover->email)->first();
            $approval = ApprovalProgress::where('badge_request_id', $id)
                ->where('approver_id', $userApprover->id)
                ->first();
            if ($approval) {
                $badgeRequest = $approval->badgeRequest;
                $approved = $approval->approved == 1 ? true : false;
                $motif = $approval->motif;

                return view('approbation.single', compact("badgeRequest", "approved", "motif"));
            } else {
                return response()->view('erreur.error404', [], 404);
            }
        } else {
            return response()->view('erreur.error403', [], 403);
        }
    }
}