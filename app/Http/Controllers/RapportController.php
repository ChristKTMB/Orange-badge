<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\approving;
use App\Models\BadgeRequest;
use Illuminate\Http\Request;
use App\Models\ApprovalProgress;
use Illuminate\Support\Facades\DB;

class RapportController extends Controller
{
    //
    public function index(Request $request) {

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        

        
        $query = ApprovalProgress::select('approvals_progress.*')
            ->join(DB::raw("(SELECT badge_request_id, MAX(id) as max_id FROM approvals_progress GROUP BY badge_request_id) latest_approvals"), function($join)
        {
        $join->on('approvals_progress.id', '=', 'latest_approvals.max_id');
        })->with('badgeRequest');
    
        if ($start_date && $end_date) {
            // Filtrez les données en fonction des dates saisies
            $query->whereBetween('approvals_progress.created_at', [$start_date, $end_date]);
            
        }
    
        $ApprovalProgress = $query->get();

        return view('rapport.index', compact('ApprovalProgress'));
    }

    public function show($badgeRequestId)
    {
        $badgeRequest = BadgeRequest::findOrFail($badgeRequestId);
        $approvers = approving::all()->toArray();

        return view('rapport.show', compact('badgeRequest','approvers'));
    }

}
