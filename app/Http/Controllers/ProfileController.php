<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pro', compact('user'));
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo')) {
            $photoContent = base64_encode(file_get_contents($request->file('photo')->getRealPath()));
            $user->photo = $photoContent;
            $user->save();

            return redirect()->back()->with('success', 'Profile photo updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to upload photo');
    }
}