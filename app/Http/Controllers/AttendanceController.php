<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AttendanceController extends Controller
{

    /**
     * Remaining Days ALERTS
     */
    public function payementAlert(Booking $book)
    {
        if ($book->due_payment > 0) {
            if ($book->remaining_days == $book->getAttendanceHalf()) {
                dd('HALF DAYS');
            }
            if ($book->remaining_days == 2) {
                dd('LAST 2 DAYS REMAINING');
            }
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
        // get the data
        $data = $request->only(['booking_id', 'attendance_image']);
        $booking = Booking::findOrFail($data['booking_id']);

        // check the data is inserted or not

//        checking the attendance table
//        if (Attendance::all()->where('booking_id', $booking->id)->isNotEmpty()) {
//            $attendance = Attendance::where('booking_id', $booking->id)->get()->last();
//            $serverDateTime = Carbon::now();
//            //checking the date and time
//            if (explode(" ", $attendance->created_at)[0] == explode(" ", $serverDateTime)[0]) {
//                return redirect(route('nurse.index'))->with('success', 'Attendance was marked as \'present\' already!');
//            }
//        }

        // checking the image is there or not
        if ($request->hasFile('attendance_image')) {
            //resizing the image using image intervention
            $img = Image::make($data['attendance_image'])->resize(null, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg');


            //storing the image
//            $image = $img->store('attendance/' . $booking->nurse->user->name, 'public');
            $image = '/attendance/' . $booking->nurse->user->name . '/' . $data['attendance_image']->getClientOriginalName();
            Storage::disk('public')->put($image, $img);

            //create the attendance record
            Attendance::create([
                'booking_id' => $data['booking_id'],
                'photo' => $image,
                'present' => 1,
                'nurse_id' => $booking->nurse_id,
            ]);
            // reduce the remaining days
            $booking->update([
                'remaining_days' => $booking->remaining_days - 1
            ]);

            $this->payementAlert($booking);

            return redirect(route('nurse.index'))->with('success', 'Attendance marked as Present!');

        }
        //absent wala
        Attendance::create([
            'booking_id' => $data['booking_id'],
            'present' => 2,//absent
            'nurse_id' => $booking->nurse_id,
        ]);

        $booking->update([
            'remaining_days' => $booking->remaining_days - 1
        ]);

        $this->payementAlert($booking);

        return redirect(route('nurse.index'))->with('success', 'Attendance marked as Absent!');

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
