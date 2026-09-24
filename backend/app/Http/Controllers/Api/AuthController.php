<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Log an admin in and issue a Sanctum API token.
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $admin = Admin::query()->where('email', $credentials['email'])->first();

        if (! $admin || ! Auth::guard('web')->attempt($credentials, false)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $admin->createToken('admin-dashboard')->plainTextToken;

        return response()->json([
            'admin' => new AdminResource($admin),
            'token' => $token,
        ]);
    }

    /**
     * Revoke the token used to authenticate the current request.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out.']);
    }

    /**
     * Return the currently authenticated admin.
     */
    public function me(Request $request)
    {
        return new AdminResource($request->user());
    }
}
