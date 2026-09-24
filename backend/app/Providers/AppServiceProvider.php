<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Single-resource responses (show/update) come back as flat JSON
        // instead of wrapped in a top-level "data" key — this is an
        // API-only backend with one consumer (the admin frontend), so
        // there's no need for the wrapper. Paginated collections are
        // unaffected: Laravel always wraps those in data/links/meta.
        JsonResource::withoutWrapping();

        // There is no web "login" route in this API-only app. Without this,
        // an unauthenticated request that doesn't send Accept: application/json
        // (e.g. a plain curl call, a misbehaving client) makes the default
        // auth middleware try to redirect to a route('login') that doesn't
        // exist, crashing with a 500 instead of a clean 401 JSON response.
        Authenticate::redirectUsing(fn () => null);
    }
}
