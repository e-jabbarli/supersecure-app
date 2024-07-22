<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],         
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);


        $userId = (int) $request->input('id') ?: $request->user()->id;

        $hashedPassword = Hash::make($validated['password']);

        DB::statement('UPDATE users SET password = ? WHERE id = ?', [$hashedPassword, $userId]);

        return back()->with('status', 'password-updated');
    }
}
