<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Update user's email address
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->email = $request->new_email;
        $user->save();

        return redirect()
            ->route('set')
            ->with('status', 'Email updated successfully!');
    }

    /**
     * Update user's profile photo
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $photo = $request->file('photo');
        $photoContent = base64_encode(file_get_contents($photo->getRealPath()));
        
        $user->photo = $photoContent;
        $user->save();

        return redirect()
            ->route('pro')
            ->with('status', 'Profile photo updated successfully!');
    }
}