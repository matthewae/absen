<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function updateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('set')
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        $user->email = $request->new_email;
        $user->save();

        return redirect()
            ->route('set')
            ->with('status', 'Email updated successfully!');
    }
}