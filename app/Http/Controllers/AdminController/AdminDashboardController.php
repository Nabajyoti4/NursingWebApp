<?php

namespace App\Http\Controllers\AdminController;

use App\Attendance;
use App\Booking;
use App\Http\Controllers\Controller;
use App\Nurse;
use App\Patient;
use App\Psalary;
use App\Tsalary;
use Carbon\Carbon;


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
        $serverDateTime = Carbon::now();
        $booking = Booking::where('nurse_id', $id)->get();

        // reduce the remaining days
        $booking->first()->update([
            'remaining_days' => $booking->first()->remaining_days - 1
        ]);

        //updating the total working days in salary table
        $nurse = Nurse::findOrFail($booking->first()->nurse_id);
        $patient = Patient::findOrFail($booking->first()->patient_id);
        if ($nurse->permanent == 0) {
            if ($patient->shift == 'day' || $patient->shift == 'night') {
                //get the salary data
                $data = Tsalary::where('nurse_id', $booking->first()->nurse_id)
                    ->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', $serverDateTime->year)->first();
                // increase the working days
                $data->half_day = $data->half_day + 1;
                //calculation of salary
                $data->total = $data->per_day_rate * $data->full_day + $data->special_allowance + $data->ta_da
                    + ($data->half_day * ($data->per_day_rate / 2));
                //deduction payment
                $data->deduction = $data->hra + $data->bonus + $data->advance;
                $data->net = $data->total - $data->deduction;
                $data->update([$data]);
            } else {
                //get the salary data
                $data = Tsalary::where('nurse_id', $booking->first()->nurse_id)
                    ->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', $serverDateTime->year)->first();
                // increase the working days
                $data->full_day = $data->full_day + 1;
                //calculation of salary
                $data->total = $data->per_day_rate * $data->full_day + $data->special_allowance + $data->ta_da
                    + ($data->half_day * ($data->per_day_rate / 2));
                //deduction payment
                $data->deduction = $data->hra + $data->bonus + $data->advance;
                $data->net = $data->total - $data->deduction;
                $data->update([$data]);
            }
        } else {
            //get the salary data
            $data = Psalary::where('nurse_id', $booking->first()->nurse_id)
                ->whereMonth('created_at', date('m'))
                ->whereYear('created_at', $serverDateTime->year)->first();
            // increase the working days
            $data->payable_days = $data->payable_days + 1;
            //calculation of salary
            $data->total = $data->per_day_rate * $data->payable_days + $data->special_allowance;
            //ESIC (4% of Total Tsalary)
            $data->esic = $data->basic * (4 / 100);

            $data->deduction = $data->hra + $data->bonus + $data->esic + $data->pf + $data->advance;
            $data->net = $data->total - $data->deduction;

            $data->update([$data]);
        }

        // create  new attendence
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

        // reduce the remaining days
        $booking->first()->update([
            'remaining_days' => $booking->first()->remaining_days - 1
        ]);

        Attendance::create([
            'booking_id' => $booking->last()->id,
            'present' => 2,
            'nurse_id' => $id,
        ]);

        $nurses = Nurse::where('status', 1)->get();
        return redirect()->route('admin.dashboard.mark', compact('nurses'))
            ->with('success', 'Attendance Marked');
    }
}
