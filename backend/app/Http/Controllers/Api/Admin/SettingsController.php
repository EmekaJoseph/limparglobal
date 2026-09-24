<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingsRequest;
use App\Models\SiteSetting;

class SettingsController extends Controller
{
    /**
     * Show the site's public contact settings.
     */
    public function show()
    {
        return response()->json(SiteSetting::current());
    }

    /**
     * Update the site's public contact settings.
     */
    public function update(UpdateSettingsRequest $request)
    {
        $settings = SiteSetting::current();
        $settings->fill($request->validated())->save();

        return response()->json($settings->fresh());
    }
}
