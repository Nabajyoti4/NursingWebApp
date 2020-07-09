<?php

namespace App\Http\Controllers\AdminController;

use App\Attendance;
use App\Booking;
use App\Http\Controllers\Controller;
use App\Nurse;


class AdminDashboardController extends Controller
{
    //
    /**
     * display current date attendance
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function today_attendance(){
        $nurses = Nurse::where('status', 1)->get();
        return view('admin.dashboard.mark', compact('nurses'));
    }


    /**
     * mark present from admin side
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mark_present($id){
        $booking = Booking::where('nurse_id', $id)->get();

        Attendance::create([
            'booking_id' => $booking->last()->id,
            'photo' => 'null',
            'present' => 1,
            'nurse_id' => $id,
        ]);

        $nurses = Nurse::where('status', 1)->get();
        return redirect()->route('admin.dashboard.mark', compact('nurses'))
            ->with('success', 'Attendance Marked');
    }

    /**
     * mark absent from admin side
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mark_absent($id){
        $booking = Booking::where('nurse_id', $id)->get();

        Attendance::create([
            'booking_id' => $booking->last()->id,
            'present' => 3,
            'nurse_id' => $id,
        ]);

        $nurses = Nurse::where('status', 1)->get();
        return redirect()->route('admin.dashboard.mark', compact('nurses'))
            ->with('success', 'Attendance Marked');
    }
}
