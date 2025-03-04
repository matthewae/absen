<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function update(Request $request)
    {        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if ($request->current_password !== $user->password) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = $request->new_password;
        $user->save();

        return back()->with('status', 'Password updated successfully.');
    }
}