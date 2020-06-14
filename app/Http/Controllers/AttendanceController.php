<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // get the data
        $data = $request->only(['booking_id', 'attendance_image']);
        $booking = Booking::findOrFail($data['booking_id']);

        // check the data is inserted or not
        if (Attendance::all()->where('booking_id', $booking->id)->isNotEmpty()){
            $attendance = Attendance::where('booking_id', $booking->id)->get()->first();
            $serverDateTime = Carbon::now();
            //checking the date and time
            if (explode(" ",$attendance->created_at)[0] == explode(" ",$serverDateTime)[0]){
                return redirect(route('nurse.index'))->with('success', 'Attendance was marked as \'present\' already!');
            }
        }

        // checking the image is there or not
        if ($request->hasFile('attendance_image')) {
            //storing the image
            $image = $data['attendance_image']->store('attendance/' . $booking->nurse->user->name, 'public');
            //create the attendance record
            Attendance::create([
                'booking_id' => $data['booking_id'],
                'photo' => $image,
                'present'=>1
            ]);
        }

        return redirect(route('nurse.index'))->with('success', 'Attendance marked as Present!');
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
