<?php

namespace App\Http\Controllers\Nurse;

use App\Attendance;
use App\Booking;
use App\Http\Controllers\Controller;
use App\Nurse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // find the current user
        $user = Auth::user();
        // find thw nurse with the id same as user_id
        $nurse = $user->nurse;
        $bookings = Booking::where('nurse_id', $nurse->id)->get();
        // getting the time and date
        $dateTime = Carbon::now()->format('Y:m:d');
        // seperating the time na date
        $date = explode(" ",$dateTime)[0];
        // check if there is attendance for the nurse
        if (Attendance::all()->where('nurse_id',$nurse->id)->isNotEmpty())
        {
            $attendances = Attendance::where('nurse_id',$nurse->id)->get();
            return view('nurses.index', compact('user', 'nurse','bookings','date','attendances'));

        }

        return view('nurses.index', compact('user', 'nurse','bookings','date'));

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
