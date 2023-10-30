<?php

namespace App\Http\Controllers;

use App\Models\Approving;
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
        
        $badgeRequest = BadgeRequest::orderBy('created_at', 'desc');
            
            if ($start_date && $end_date) {
                $badgeRequest->whereBetween('created_at', [$start_date, $end_date]);
            }
            $badgeRequest = $badgeRequest->get();

        return view('rapport.index', compact('badgeRequest'));
    }
}
