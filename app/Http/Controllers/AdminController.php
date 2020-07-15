<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Nurse;
use App\NurseJoinRequest;
use App\Patient;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        if ($admin->role == 'super') {

            $userAll = User::all()->where('role', 'user');
            $userids = array();
            foreach ($userAll as $user) {
                array_push($userids, $user->id);
            }
            $nurseRequest = NurseJoinRequest::whereIn('user_id', $userids)->where('Approval', 2)->get()->count();

            $patientAll = Patient::all();
            $ppatientids = array();//pending
            foreach ($patientAll as $patient) {
                if ($patient->status == 2) {
                    array_push($ppatientids, $patient->id);
                }
            }
            $ppatientRequest = Patient::whereIn('id', $ppatientids)->get()->count();
            $users = User::all()->where('role', 'user')->count();
            $nurses = Nurse::all()->count();
            $patients = Patient::all()->count();
            $rbooking = Booking::all()->where('status', 0)->count();
            $cbooking = Booking::all()->where('status', 1)->count();
            $pbooking = Booking::all()->where('status', 2)->count();
            $abooking = Booking::all()->where('status', 3)->count();
            $tbooking = Booking::all()->where('status', 4)->count();

        } else {

            $userAll = User::where('role', 'user')->where('permanent_address_id', '>', 0)->where('current_address_id', '>', 0)->get();
            $userids = array();
            foreach ($userAll as $user) {
                if (($user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                    array_push($userids, $user->id);
                }

            }
            $nurseRequest = NurseJoinRequest::whereIn('user_id', $userids)->where('Approval', 2)->get()->count();

            $patientAll = Patient::all();
            $ppatientids = array();//pending
            foreach ($patientAll as $patient) {
                if (($patient->getAddress()) == ($admin->addresses->first()->city)) {
                    if ($patient->status == 2) {
                        array_push($ppatientids, $patient->id);
                    }
                }
            }
            $ppatientRequest = Patient::whereIn('id', $ppatientids)->get()->count();

            $users = collect([]);
            $nurses = collect([]);
            $patients = collect([]);
            $rbooking = collect([]);
            $cbooking = collect([]);
            $pbooking = collect([]);
            $abooking = collect([]);
            $tbooking = collect([]);
        }
        return view('admin.index', compact('ppatientRequest', 'nurseRequest', 'admin', 'users', 'nurses', 'patients', 'rbooking', 'cbooking', 'abooking', 'tbooking', 'pbooking'));
    }
}
