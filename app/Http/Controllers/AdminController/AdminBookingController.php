<?php

namespace App\Http\Controllers\AdminController;

use App\Attendance;
use App\Booking;
use App\Http\Controllers\Controller;
use App\Nurse;
use App\Patient;
use Illuminate\Http\Request;
use SebastianBergmann\Comparator\Book;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $bookings = Booking::all();

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
            if (($nurse->user->addresses->last()->city) == ($patient->getAddress())) {
                array_push($nurses, $nurse);
            }
        }
        return view('admin.bookings.create', compact('patient', 'nurses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //use request only to fetch the required data
        $data = $request->only(['patient_id','total_payment','due_payment','nurse']);

        //fetch user_id from patient
        $patient = Patient::findOrFail($data['patient_id']);


        // get the nurse and update the status to working 1
        Nurse::findOrfail($data['nurse'])->update(['status' => 1]);

        Booking::create(['user_id' => $patient->user->id,
                        'patient_id' => $data['patient_id'],
                        'nurse_id' => $data['nurse'],
                        'total_payment' => $data['total_payment'],
                        'due_payment' => $data['due_payment'],
                        'remaining_days' => $patient->days]
                        );


        $bookings = Booking::all();
        return redirect()
            ->route('admin.book.index', compact('bookings'))
            ->with('success','Booking done successfully!');




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
        $book = Booking::findOrFail($id);
        $attendances = Attendance::where('booking_id',$book->id)->get();
        return view('admin.bookings.show', compact('book', 'attendances'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        //
        Booking::findOrFail($id)->update(['status'=>3]);
        return redirect()->back();
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
        $booking = Booking::findOrFail($id);
        $data = $request->only(['action']);

        $value = $data['action'];

        // 0 reject
        if($value == 0){
            $booking->update(['status'=>3]);
        }

        // 4 takeover action
        elseif ($value == 4){
            // update the booking status to take over
            $booking->update(['status'=>4]);

            $patient = Patient::findOrFail($booking->patient_id);

            // update the nurse status to not working and set to leave
            Nurse::findOrfail($booking->nurse_id)->update(['status' => 0,
                'is_active' => 0]);


            // fetch the other nurse who are active
            $nursesAll = Nurse::select('*')
                         ->where('is_active', 1)
                         ->where('status', 0)
                         ->get();


            //  find the nurse same as patient address
            $nurses = array();

            foreach ($nursesAll as $nurse) {
                if (($nurse->user->addresses->last()->city) == ($patient->getAddress())) {
                    array_push($nurses, $nurse);
                }
            }

            return view('admin.bookings.takeover', compact('booking', 'nurses'));
        }
        // 1 complete
        else{
            $booking->update(['status'=>1]);
        }


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


    /**
     * @param $id
     * extend the booking for required days
     */
    public function request($id){
        $booking = Booking::findOrFail($id);

        return view('admin.bookings.extend', compact('booking'));
    }


    public function extend(Request $request){
        //use request only to fetch the required data
        $data = $request->only(['patient_id','total_payment','due_payment','nurse', 'days']);

        //fetch user_id from patient
        $old_patient = Patient::findOrFail($data['patient_id']);

        // create a new patient
        $patient = Patient::create(['user_id' =>  $old_patient->user->id,
            'patient_name' => $old_patient->patient_name,
            'photo_id' => $old_patient->photo_id,
            'phone_no' => $old_patient->phone_no,
            'age' => $old_patient->age,
            'gender' => $old_patient->gender,
            'address_id' => $old_patient->address_id,
            'family_members' => $old_patient->family_members,
            'guardian_name' => $old_patient->guardian_name,
            'relation_guardian' => $old_patient->relation_guardian,
            'shift' => $old_patient->shift,
            'days' => $data['days'],
            'service_id' => $old_patient->service_id,
            'patient_history' => $old_patient->patient_history,
            'patient_doctor' => $old_patient->patient_doctor
        ]);


        Booking::create(['user_id' => $patient->user->id,
                'patient_id' => $data['patient_id'],
                'nurse_id' => $data['nurse'],
                'total_payment' => $data['total_payment'],
                'due_payment' => $data['due_payment'],
                'remaining_days' => $patient->days]
        );


        $bookings = Booking::all();
        return redirect()
            ->route('admin.book.index', compact('bookings'))
            ->with('success','Booking done successfully!');
    }
}
