<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Booking;
use App\Nurse;
use App\Patient;
use App\Psalary;
use App\Tsalary;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AttendanceController extends Controller
{

    /**
     * @param Booking $book
     */
    public function payementAlert(Booking $book)
    {
        $adminAll = User::where('role', 'admin')->get();
        $patient = Patient::where('id', $book->patient_id)->get();
        $user = User::where('id', $book->user_id)->get();

        $admins = array();
        foreach ($adminAll as $admin) {
            if ($admin->addresses->first()->city == $patient->first()->getAddress()) {
                array_push($admins, $admin);
            }
        }

        if ($book->remaining_days >= 2) {
            if ($book->due_payment > 0) {
                if ($book->remaining_days == $book->getAttendanceHalf()) {
                    Notification::send($admins, new \App\Notifications\PaymentAlert\AdminAlert($book, $admins));
                    Notification::send($user, new \App\Notifications\PaymentAlert\UserAlert($book, $user));
                }
                if ($book->remaining_days == 2) {
                    Notification::send($admins, new \App\Notifications\PaymentAlert\AdminAlert($book, $admins));
                    Notification::send($user, new \App\Notifications\PaymentAlert\UserAlert($book, $user));
                }
            }
        } elseif ($book->remaining_days == 0) {
            $book->status = 1;
            $book->save();

            Notification::send($admins, new \App\Notifications\PaymentAlert\AdminAlert($book, $admins));
            Notification::send($user, new \App\Notifications\PaymentAlert\UserAlert($book, $user));
            return redirect(route('nurse.index'))->with('success', 'This booking is completed');
        } else {
            Notification::send($admins, new \App\Notifications\PaymentAlert\AdminAlert($book, $admins));
            Notification::send($user, new \App\Notifications\PaymentAlert\UserAlert($book, $user));
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $serverDateTime = Carbon::now();

        // get the data
        $data = $request->only(['booking_id', 'absent']);
        $booking = Booking::findOrFail($data['booking_id']);
        $nurse = Nurse::where('id', $booking->nurse_id)->get()->first();
        if ($nurse->permanent == 1) {
            if (Psalary::where('nurse_id', $nurse->employee_id)->whereMonth('created_at', date('m'))
                ->whereYear('created_at', $serverDateTime->year)->get()->isEmpty()) {
                return redirect()->back()->with('info', 'Ask Admin to create salary.');
            }
        } else {
            if (Tsalary::where('nurse_id', $nurse->employee_id)->whereMonth('created_at', date('m'))
                ->whereYear('created_at', $serverDateTime->year)->get()->isEmpty()) {
                return redirect()->back()->with('info', 'Ask Admin to create salary.');
            }
        }
        // check the data is inserted or not

//        checking the attendance table
        if (Attendance::all()->where('booking_id', $booking->id)->isNotEmpty()) {
            $attendance = Attendance::where('booking_id', $booking->id)->get()->last();
            //checking the date and time
            if (explode(" ", $attendance->created_at)[0] == explode(" ", $serverDateTime)[0]) {
                return redirect(route('nurse.index'))->with('success', 'Attendance was marked as \'present\' already!');
            }
        }

//        // checking the image is there or not
//        if ($request->hasFile('attendance_image')) {
//            //resizing the image using image intervention
//            $img = Image::make($data['attendance_image'])->resize(null, 600, function ($constraint) {
//                $constraint->aspectRatio();
//                $constraint->upsize();
//            })->encode('jpg');
//
//
//            //storing the image
////            $image = $img->store('attendance/' . $booking->nurse->user->name, 'public');
//            $image = '/attendance/' . $booking->nurse->user->name . '/' . $data['attendance_image']->getClientOriginalName();
//            Storage::disk('public')->put($image, $img);
//if absent
        if ($data['absent'] == 1) {

            //absent wala
            $attendance = Attendance::create([
                'booking_id' => $data['booking_id'],
                'present' => 2,//absent
                'nurse_id' => $booking->nurse_id,
            ]);

            $booking->update([
                'remaining_days' => $booking->remaining_days - 1
            ]);

            $this->payementAlert($booking);
            $adminAll = User::where('role', 'admin')->get();
            $nurse = Nurse::findOrFail($attendance['nurse_id']);

            $admins = array();
            foreach ($adminAll as $admin) {
                if ($admin->addresses->first()->city == $nurse->first()->user->addresses->first()->city)
                    array_push($admins, $admin);
            }


            return redirect()->back()->with('success', 'Attendance marked as Absent!');
        }
        // present create the attendance record
        $attendance = Attendance::create([
            'booking_id' => $data['booking_id'],
            'present' => 1,
            'nurse_id' => $booking->nurse_id,
        ]);
        // reduce the remaining days
        $booking->update([
            'remaining_days' => $booking->remaining_days - 1
        ]);

        //updating the total working days in salary table
        $nurse = Nurse::findOrFail($booking['nurse_id']);
        $patient = Patient::findOrFail($booking['patient_id']);
        if ($nurse->permanent == 0) {
            if ($patient->shift == 'day' || $patient->shift == 'night') {
                //get the salary data

                $data = Tsalary::where('nurse_id', $nurse->employee_id)
                    ->where('month_days', Carbon::now()->format('Y-m'))
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
                $data = Tsalary::where('nurse_id', $nurse->employee_id)
                    ->whereMonth('month_days', date('Y-m'))
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
            $data = Psalary::where('nurse_id', $nurse->employee_id)
                ->whereMonth('month_days', date('Y-m'))
                ->whereYear('created_at', $serverDateTime->year)->first();
            // increase the working days
            $data->payable_days = $data->payable_days + 1;
            //calculation of salary
            $data->total = $data->per_day_rate * $data->payable_days + $data->special_allowance + $data->ta_da;
            //ESIC (4% of Total Psalary)
            $data->esic = $data->basic * (4 / 100);

            $data->deduction = $data->hra + $data->bonus + $data->esic + $data->pf + $data->advance;
            $data->net = $data->total - $data->deduction;

            $data->update([$data]);
        }

        $this->payementAlert($booking);


        $adminAll = User::where('role', 'admin')->get();
        $nurse = Nurse::findOrFail($attendance['nurse_id']);

        $admins = array();
        foreach ($adminAll as $admin) {
            if ($admin->addresses->first()->city == $nurse->first()->user->addresses->first()->city)
                array_push($admins, $admin);
        }


        return redirect()->back()->with('success', 'Attendance marked as Present!');

//        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
