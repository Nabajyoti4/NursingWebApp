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
use Illuminate\Support\Facades\Auth;


class AdminDashboardController extends Controller
{
    //
    /**
     * display current date attendance
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function today_attendance()
    {
        $bookingsAll = Booking::where('status', 3)->get();
        $admin = Auth::user();
        $bookings=[];
        if ($admin->role == 'admin'){
            foreach ($bookingsAll as $booking) {
                if ($admin->address($admin->getCAddressId($admin->id))->city == $booking->patient->getAddress()){
                    array_push($bookings, $booking);
                }
            }
            return view('admin.dashboard.mark', compact('bookings'));

        }

        return view('admin.dashboard.mark', compact('bookings'));
    }


    /**
     * mark present from admin side
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mark_present($id)
    {
        $serverDateTime = Carbon::now();
        $booking = Booking::where('nurse_id', $id)->get()->last();
        $nurse = Nurse::where('id', $booking->nurse_id)->get()->first();

        // check for permanent or temp table for nurse
        if ($nurse->permanent == 1) {
            if (Psalary::where('nurse_id', $nurse->employee_id)->where('month_days', date('Y-m'))->get()->isEmpty()) {
                return redirect()->back()->with('info', 'Create Salary for Nurse In Permanent');
            }
        } else {
            if (Tsalary::where('nurse_id', $nurse->employee_id)->where('month_days', date('Y-m'))->get()->isEmpty()) {
                return redirect()->back()->with('info', 'Create Salary for Nurse In Temporary');
            }
        }


        // reduce the remaining days
        $booking['remaining_days'] = $booking->remaining_days - 1;


        //updating the total working days in salary table
        $nurse = Nurse::findOrFail($booking->nurse_id);

        $patient = Patient::findOrFail($booking->patient_id);

        if ($nurse->permanent == 0) {
            if ($patient->shift == 'day' || $patient->shift == 'night') {
                //get the salary data
                $data = Tsalary::where('nurse_id', $nurse->employee_id)
                    ->where('month_days', date('Y-m'))->first();
                // increase the working days
                $data->full_day = $data->full_day + 1;
                //calculation of salary
                $data->total = $data->per_day_rate * $data->full_day + $data->special_allowance + $data->ta_da
                    + ($data->half_day * ($data->per_day_rate / 2));
                //deduction payment
                $data->deduction = $data->hra + $data->bonus + $data->advance;
                $data->net = $data->total - $data->deduction;
//                $data->update([$data]);
            } else {
                //get the salary data
                $data = Tsalary::where('nurse_id', $nurse->employee_id)
                    ->where('month_days', date('Y-m'))->first();
                // increase the working days
                $data->full_day = $data->full_day + 1;
                //calculation of salary
                $data->total = $data->per_day_rate * $data->full_day + $data->special_allowance + $data->ta_da
                    + ($data->half_day * ($data->per_day_rate / 2));
                //deduction payment
                $data->deduction = $data->hra + $data->bonus + $data->advance;
                $data->net = $data->total - $data->deduction;
//                $data->update([$data]);
            }
        } else {
            //get the salary data
            $data = Psalary::where('nurse_id', $nurse->employee_id)
                ->where('month_days', date('Y-m'))->first();
            // increase the working days
            $data->full_day = $data->full_day + 1;
            //calculation of salary
            $data->total = $data->per_day_rate * $data->full_day + $data->ta_da + $data->special_allowance
                + ($data->half_day * ($data->per_day_rate / 2));
            //ESIC (4% of Total Tsalary)
            $data->esic = $data->basic * (4 / 100);

            $data->deduction = $data->hra + $data->bonus + $data->esic + $data->pf + $data->advance;
            $data->net = $data->total - $data->deduction;

//            $data->update([$data]);
        }


        // create  new attendence
        Attendance::create([
            'booking_id' => $booking->id,
            'present' => 1,
            'nurse_id' => $id,
        ]);

        //save booking
        $booking->save();

        if ($booking->remaining_days === 0) {
            $booking['status'] = 1;
            $nurse['status'] = 0;
        }

        $booking->save();
        $nurse->save();

        //save salary
        $data->save();

        $nurses = Nurse::where('status', 1)->get();
        return redirect()->route('admin.dashboard.mark', compact('nurses'))
            ->with('success', 'Attendance Marked');
    }

    /**
     * mark absent from admin side
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mark_absent($id)
    {

        $booking = Booking::where('nurse_id', $id)->get();
        $serverDateTime = Carbon::now();
        $nurse = Nurse::where('id', $booking->first()->nurse_id)->get()->first();
        if ($nurse->permanent == 1) {
            if (Psalary::where('nurse_id', $nurse->employee_id)->where('month_days', date('Y-m'))
                ->get()->isEmpty()) {
                return redirect(route('nurse.index'))->with('info', 'Ask Admin to create salary.');
            }
        } else {
            if (Tsalary::where('nurse_id', $nurse->employee_id)->where('month_days', date('Y-m'))
                ->get()->isEmpty()) {
                return redirect(route('nurse.index'))->with('info', 'Ask Admin to create salary.');
            }
        }
        // reduce the remaining days
        $booking->first()->update([
            'remaining_days' => $booking->first()->remaining_days - 1
        ]);

        if ($booking->first()->remaining_days === 0) {
            $booking->first()->status = 1;
            $nurse['status'] = 0;
        }

        $booking->first()->save();
        $nurse->save();

        Attendance::create([
            'booking_id' => $booking->last()->id,
            'present' => 2,
            'nurse_id' => $id,
        ]);

        $nurses = Nurse::where('status', 1)->get();
        return redirect()->route('admin.dashboard.mark', compact('nurses'))
            ->with('success', 'Attendance Marked');
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function monthly_attendance()
    {
        $admin = Auth::user();


        // get all permanent nurses
        if ($admin->role == 'super') {
            $permanent_nurses = Nurse::where('permanent', 1)->get();
            $temporary_nurses = Nurse::where('permanent', 0)->get();
            return view('admin.dashboard.attendence', compact('permanent_nurses', 'temporary_nurses'));

        } else {
            $permanent_nurse = Nurse::where('permanent', 1)->get();
            $permanent_nurses = array();
            if ($permanent_nurse->isEmpty()) {
                $permanent_nurses = collect([]);
            } else {

                foreach ($permanent_nurse as $nurse) {
                    if (($nurse->user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        array_push($permanent_nurses, $nurse);
                    }
                }
            }

            //get all temporary nurses
            $temporary_nurse = Nurse::where('permanent', 0)->get();
            $temporary_nurses = array();
            if ($temporary_nurse->isEmpty()) {
                $temporary_nurses = collect([]);
            } else {
                foreach ($temporary_nurse as $nurse) {
                    if (($nurse->user->address($nurse->user->getCAddressId($nurse->user->id))->city) == ($admin->address($admin->getCAddressId($admin->id))->city)) {
                        array_push($temporary_nurses, $nurse);
                    }
                }
            }


            return view('admin.dashboard.attendence', compact('permanent_nurses', 'temporary_nurses'));
        }

    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function permanent_report($id)
    {
        $nurse = Nurse::where('id', $id)->get();
        $permanent_salary = Psalary::where('nurse_id', $nurse->first()->employee_id)->get();
        $temporary_salary = Tsalary::where('nurse_id', $nurse->first()->employee_id)->get();
        return view('admin.dashboard.report', compact('permanent_salary', 'temporary_salary'));

    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function temporary_report($id)
    {
        $nurse = Nurse::where('id', $id)->get();
        $permanent_salary = Psalary::where('nurse_id', $nurse->first()->employee_id)->get();
        $temporary_salary = Tsalary::where('nurse_id', $nurse->first()->employee_id)->get();
        return view('admin.dashboard.report', compact('permanent_salary', 'temporary_salary'));
    }
}
