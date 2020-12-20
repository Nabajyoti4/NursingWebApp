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
        $patients=Patient::where('status',1)->get();

        return view('admin.receipts.index',compact('patients'));
    }
    public function show($id){
        $bookings=Booking::where('patient_id',$id)->latest()->get();
        $patient=Patient::FindOrFail($id);
        return view('admin.receipts.show',compact('bookings','patient'));
    }
}
