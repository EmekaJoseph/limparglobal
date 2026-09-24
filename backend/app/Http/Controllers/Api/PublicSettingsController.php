<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;

class PublicSettingsController extends Controller
{
    /**
     * Public read-only subset of site settings, consumed by the marketing
     * frontend (footer/contact links). No auth — the frontend falls back
     * to its own hardcoded defaults if this is unreachable.
     */
    public function show()
    {
        $settings = SiteSetting::current();

        return response()->json([
            'email' => $settings->email,
            'phone' => $settings->phone,
            'linkedin' => $settings->linkedin,
        ]);
    }
}
