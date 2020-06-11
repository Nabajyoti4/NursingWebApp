<?php

namespace App\Http\Controllers\AdminController;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Nurse;
use App\Patient;
use App\Nurse;
use Illuminate\Http\Request;
use SebastianBergmann\Comparator\Book;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bookings.create', compact('patient'));
    }

    public function bookCreate($id)
    {
        $patient = Patient::findOrFail($id);
        $nursesAll = Nurse::all();
        $nurses = array();
        foreach ($nursesAll as $nurse) {
            if (($nurse->user->addresses->last()->city) == ($patient->user->addresses->first()->city)) {
                array_push($nurses, $nurse);
            }
        }
        return view('admin.bookings.create', compact('patient', 'nurses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $book = Booking::findOrFail($id);
        return view('admin.bookings.show', compact('book'));
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
