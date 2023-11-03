<?php

namespace App\Http\Controllers;

use App\Models\BadgeRequest;
use Illuminate\Http\Request;
use App\Models\ApprovalProgress;
use Illuminate\Support\Facades\DB;

class GraphicRapportController extends Controller
{
    public function index(Request $request)
    {
        $totalRequests = BadgeRequest::count();

        $nombreDeRefuses = ApprovalProgress::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('approvals_progress')
                ->groupBy('badge_request_id');
        })->whereNotNull('motif')->count();

        $nombreApprouves = ApprovalProgress::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('approvals_progress')
                ->groupBy('badge_request_id');
        })->where('approved', 1)->count();

        $nombreEnAttente = ApprovalProgress::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('approvals_progress')
                ->groupBy('badge_request_id');
        })->where('approved', 0)->whereNull('motif')->count();

        $years = BadgeRequest::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();

        $year = $request->input('year', date('Y'));
        $selectedYear = $request->input('year', date('Y'));
        $badgeRequestsByMonth = $this->getBadgeRequestsByMonth($year);
        $approvalsByMonth = $this->getApprovalsProgressByMonth($year);
        $refusalsByMonth = $this->getApprovalsProgressByMonthRefuser($year);
        $attentesByMonth = $this->getApprovalsProgressByMonthEnAttente($year);

        return view("rapport.graphique", compact("totalRequests", "nombreDeRefuses", "nombreApprouves", "nombreEnAttente", "badgeRequestsByMonth", "approvalsByMonth", "refusalsByMonth", "attentesByMonth", "years", "year", "selectedYear"));
    }
    public function getBadgeRequestsByMonth($year)
    {
        $badgeRequestsByMonth = [];

        for ($month = 1; $month <= 12; $month++) {
            $badgeRequestsCount = BadgeRequest::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)->count();
            $monthName = date("F", mktime(0, 0, 0, $month, 1)); // Obtient le nom du mois

            $badgeRequestsByMonth[$monthName] = $badgeRequestsCount;
        }

        return $badgeRequestsByMonth;
    }
    public function getApprovalsProgressByMonth($year)
    {
        $dataByMonth = [];

        for ($month = 1; $month <= 12; $month++) {
            $dataCount = ApprovalProgress::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)->whereIn('id', function ($query) {
                    $query->selectRaw('MAX(id)')
                        ->from('approvals_progress')
                        ->groupBy('badge_request_id');
                })->where('approved', 1)->count();

            $monthName = date("F", mktime(0, 0, 0, $month, 1));

            $dataByMonth[$monthName] = $dataCount;
        }

        return $dataByMonth;
    }
    public function getApprovalsProgressByMonthRefuser($year)
    {
        $dataByMonth1 = [];

        for ($month = 1; $month <= 12; $month++) {
            $dataCount1 = ApprovalProgress::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)->whereIn('id', function ($query) {
                    $query->selectRaw('MAX(id)')
                        ->from('approvals_progress')
                        ->groupBy('badge_request_id');
                })->whereNotNull('motif')->count();

            $monthName1 = date("F", mktime(0, 0, 0, $month, 1));

            $dataByMonth1[$monthName1] = $dataCount1;
        }

        return $dataByMonth1;
    }
    public function getApprovalsProgressByMonthEnAttente($year)
    {
        $dataByMonth2 = [];

        for ($month = 1; $month <= 12; $month++) {
            $dataCount2 = ApprovalProgress::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)->whereIn('id', function ($query) {
                    $query->selectRaw('MAX(id)')
                        ->from('approvals_progress')
                        ->groupBy('badge_request_id');
                })->where('approved', 0)->whereNull('motif')->count();

            $monthName2 = date("F", mktime(0, 0, 0, $month, 1));

            $dataByMonth2[$monthName2] = $dataCount2;
        }

        return $dataByMonth2;
    }
}
