<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('super');
    }

    public function showLoginForm()
    {
        return view('auth.LGSuper');
    }
}