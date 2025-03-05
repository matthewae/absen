<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|unique:users,staff_id',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = new User();
        $user->staff_id = $request->staff_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role ?? 'staff';
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->department = $request->department;
        $user->position = $request->position;
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->password = bcrypt($request->password);

        // Convert image to binary and store in database
        if ($request->hasFile('photo')) {
            $user->photo = file_get_contents($request->file('photo')->getRealPath());
        }

        $user->save();

        return redirect()->back()->with('success', 'User created successfully');
    }

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