<?php

namespace App\Http\Controllers\AdminController;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReceiptController extends Controller
{
    //
    public function index(){
        $admin = Auth::user();
        $patientsAll = Patient::where('status', 1)->get()->unique('patient_id');
        $patients = [];
        if ($admin->role == 'admin') {
            foreach ($patientsAll as $patient) {
                if ($admin->address($admin->getCAddressId($admin->id))->city == $patient->office_location) {
                    array_push($patients, $patient);
                }
            }
            return view('admin.receipts.index', compact('patients'));
        }
        $patients = $patientsAll;
        return view('admin.receipts.index', compact('patients'));
    }
    public function show($patient_id){
        $patientsAll = Patient::where('patient_id',$patient_id)->get();
        $bookings=Booking::whereIn('patient_id',$patientsAll)->latest()->get();
        $patient=Patient::where('patient_id',$patient_id)->get()->first();
        return view('admin.receipts.show',compact('bookings','patient'));
    }
}
