<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Nurse;
use App\Patient;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        $users = User::all()->where('role', 'user')->count();
        $nurses = Nurse::all()->count();
        $patients = Patient::all()->count();
        $rbooking =Booking::all()->where('status',0)->count();
        $cbooking =Booking::all()->where('status',1)->count();
        $pbooking =Booking::all()->where('status',1)->count();
        $abooking =Booking::all()->where('status',3)->count();
        $tbooking =Booking::all()->where('status',4)->count();
        return view('admin.index', compact('admins','users','nurses','patients','rbooking','cbooking','abooking','tbooking','pbooking'));
    }
}
