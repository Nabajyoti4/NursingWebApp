<?php

namespace App\Http\Controllers;

use App\Rating;
use App\Team;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ratings = Rating::all();
        $services = \App\Service::all();
        $members = Team::all();

        $patients_count = \App\Patient::all()->count();
        $nurses_count = \App\Nurse::all()->count();
        $nurses_active_count = \App\Nurse::all()->where('is_active',1)->count();
        return view('index', compact('ratings','services','members','nurses_count','nurses_active_count','patients_count'));
    }
}
