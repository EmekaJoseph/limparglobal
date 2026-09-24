<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteVisit;
use Illuminate\Http\Request;

class SiteVisitController extends Controller
{
    /**
     * Record a page visit. Public endpoint — intended to be called once per
     * page load from the frontend (not wired up there yet).
     */
    public function track(Request $request)
    {
        $data = $request->validate([
            'path' => ['nullable', 'string', 'max:255'],
            'referrer' => ['nullable', 'string', 'max:255'],
        ]);

        SiteVisit::query()->create([
            'ip_address' => $request->ip(),
            'path' => $data['path'] ?? null,
            'referrer' => $data['referrer'] ?? null,
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(status: 204);
    }
}
