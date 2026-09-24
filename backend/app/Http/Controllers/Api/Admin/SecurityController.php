<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;

class SecurityController extends Controller
{
    /**
     * Change the authenticated admin's password.
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $admin = $request->user();

        if (! Hash::check($request->validated('current_password'), $admin->password)) {
            return response()->json([
                'message' => 'The current password is incorrect.',
                'errors' => ['current_password' => ['The current password is incorrect.']],
            ], 422);
        }

        $admin->update([
            'password' => Hash::make($request->validated('new_password')),
        ]);

        // Revoke every other token so other sessions are logged out.
        $admin->tokens()->where('id', '!=', $request->user()->currentAccessToken()->id)->delete();

        return response()->json(['message' => 'Password updated.']);
    }
}
