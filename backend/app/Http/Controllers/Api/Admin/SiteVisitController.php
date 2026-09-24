<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteVisit;
use Illuminate\Support\Facades\DB;

class SiteVisitController extends Controller
{
    /**
     * List visitors grouped by IP address: visit count, first/last seen,
     * and the most recently seen path and user agent for that IP.
     */
    public function index()
    {
        $visitors = SiteVisit::query()
            ->select('ip_address')
            ->selectRaw('COUNT(*) as visit_count')
            ->selectRaw('MIN(created_at) as first_seen')
            ->selectRaw('MAX(created_at) as last_seen')
            ->groupBy('ip_address')
            ->orderByDesc('last_seen')
            ->paginate(25);

        // Attach the most recent path/user agent seen for each IP on this page.
        $ips = collect($visitors->items())->pluck('ip_address');
        $latestByIp = SiteVisit::query()
            ->whereIn('ip_address', $ips)
            ->select('ip_address', 'path', 'user_agent', 'referrer', 'created_at')
            ->orderByDesc('created_at')
            ->get()
            ->unique('ip_address')
            ->keyBy('ip_address');

        $visitors->getCollection()->transform(function ($row) use ($latestByIp) {
            $latest = $latestByIp->get($row->ip_address);

            return [
                'ip_address' => $row->ip_address,
                'visit_count' => (int) $row->visit_count,
                'first_seen' => $row->first_seen,
                'last_seen' => $row->last_seen,
                'last_path' => $latest?->path,
                'last_referrer' => $latest?->referrer,
                'last_user_agent' => $latest?->user_agent,
            ];
        });

        return response()->json($visitors);
    }
}
