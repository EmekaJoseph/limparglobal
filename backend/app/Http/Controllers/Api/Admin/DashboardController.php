<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployerRequest;
use App\Models\SiteVisit;
use App\Models\TalentApplication;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Summary numbers for the admin dashboard homepage.
     */
    public function index()
    {
        $today = Carbon::today();
        $weekAgo = Carbon::now()->subDays(7);

        return response()->json([
            'talent_applications' => [
                'total' => TalentApplication::query()->count(),
                'new' => TalentApplication::query()->where('review_status', 'new')->count(),
                'this_week' => TalentApplication::query()->where('created_at', '>=', $weekAgo)->count(),
            ],
            'employer_requests' => [
                'total' => EmployerRequest::query()->count(),
                'new' => EmployerRequest::query()->where('review_status', 'new')->count(),
                'this_week' => EmployerRequest::query()->where('created_at', '>=', $weekAgo)->count(),
            ],
            'visitors' => [
                'total_visits' => SiteVisit::query()->count(),
                'unique_ips' => SiteVisit::query()->distinct('ip_address')->count('ip_address'),
                'visits_today' => SiteVisit::query()->where('created_at', '>=', $today)->count(),
                'visits_this_week' => SiteVisit::query()->where('created_at', '>=', $weekAgo)->count(),
            ],
            'recent_talent_applications' => TalentApplication::query()
                ->latest()
                ->take(5)
                ->get(['id', 'full_name', 'area_of_interest', 'review_status', 'created_at']),
            'recent_employer_requests' => EmployerRequest::query()
                ->latest()
                ->take(5)
                ->get(['id', 'organisation_name', 'roles', 'review_status', 'created_at']),
        ]);
    }
}
