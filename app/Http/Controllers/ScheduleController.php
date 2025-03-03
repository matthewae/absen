<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display the schedule page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('schedule.index');
    }
}