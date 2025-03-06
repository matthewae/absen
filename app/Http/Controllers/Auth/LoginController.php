<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/primary';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
        $this->middleware(function ($request, $next) {
            $response = $next($request);
            return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                ->header('Pragma','no-cache')
                ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        });
        $this->middleware(function ($request, $next) {
            $response = $next($request);
            return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                ->header('Pragma','no-cache')
                ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        });
    }

    public function username()
    {
        return 'staff_id';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|regex:/^[0-9]{3,6}$/',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $user = \App\Models\User::where($this->username(), $credentials[$this->username()])
            ->orWhere('supervisor_id', $credentials[$this->username()])
            ->first();

        if (!$user) {
            return false;
        }

        if ($request->input('password') === $user->password) {
            $this->guard()->login($user);
            return true;
        }

        return false;
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        if ($request->ajax()) {
            return response()->json(['message' => 'Logged out successfully'])
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        }

        return redirect('/')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0')
            ->withHeaders([
                'Clear-Site-Data' => '"cache", "cookies", "storage"'
            ]);
    }

    protected function authenticated(Request $request, $user)
    {
        if ($request->input($this->username()) === $user->supervisor_id) {
            return redirect('/dashboard/supervisor');
        }
        return redirect('/primary');
    }
}