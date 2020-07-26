<?php

namespace App\Http\Controllers\Nurse;

use App\Attendance;
use App\Booking;
use App\Http\Controllers\Controller;
use App\Nurse;
use App\Psalary;
use App\Tsalary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // find the current user
        $user = Auth::user();
        // find thw nurse with the id same as user_id
        $nurse = $user->nurse;
        $bookings = Booking::where('nurse_id', $nurse->id)->get();
        $tsalaries = Tsalary::where('nurse_id', $nurse->id)->latest()->get();
        $psalaries = Psalary::where('nurse_id', $nurse->id)->latest()->get();

        // check if there is attendance for the nurse
//        $attendances = Attendance::where('nurse_id',$nurse->id)->latest()->get();
        return view('nurses.index', compact('user', 'nurse','bookings','tsalaries','psalaries'));


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


    public function booking($id){
        $book = Booking::findOrFail($id);
        $attendances = Attendance::where('booking_id',$book->id)->latest()->get();
        // getting the time and date
        $dateTime = Carbon::now()->format('Y:m:d');
        // separating the time na date
        $date = explode(" ",$dateTime)[0];
        return view('nurses.bookshow', compact('book', 'attendances','date'));
    }
}
