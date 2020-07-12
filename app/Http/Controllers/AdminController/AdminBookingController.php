<?php

namespace App\Http\Controllers\AdminController;

use App\Attendance;
use App\Booking;
use App\Http\Controllers\Controller;
use App\Nurse;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $search = request()->get('booking');
        $admin = Auth::user();


        if ($search){
            $bookings = Booking::where("id","LIKE","%{$search}%")->get();

            if($admin->role == 'super'){
                return view('admin.bookings.index', compact('bookings'));
            }else{
                if($bookings->isEmpty()) {
                    return view('admin.bookings.index', compact('bookings'));
                    // get the address of the requested PATIENT
                    // check f the address of the candidate is same as admin
                }else{
                        if (($bookings->first()->patient->getAddress()) == ($admin->addresses->first()->city)) {
                            return view('admin.bookings.index', compact('bookings'));
                        } else {
                            $bookings = collect([]);
                            return view('admin.bookings.index', compact('bookings'));
                        }
                    }
                }
        }

        else{
            if($admin->role == 'super'){
                $patients = Patient::latest()->get();
                return view('admin.requests.patient.index', compact('patients'));

            }else {
                $bookingAll = Booking::latest()->get();
                $bookings = array();

                foreach ($bookingAll as $booking) {
                    if (($booking->patient->getAddress()) == ($admin->addresses->first()->city)) {
                        array_push($bookings, $booking);
                    }
                }
                return view('admin.bookings.index', compact('bookings'));
            }

        }

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

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bookCreate($id)
    {
        $patient = Patient::findOrFail($id);
        $nursesAll = Nurse::all();
        $nurses = array();
        foreach ($nursesAll as $nurse) {
            if (($nurse->user->addresses->first()->city) == ($patient->getAddress())) {
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
     * update the booking based on the request
     * reject if no reserve nurse is their
     * takeover if new nurse is available
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response|
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

            $patient = Patient::findOrFail($booking->patient_id);

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
     * forward the extend request to the extend create view form
     * pass the booking details of the old booking
     */
    public function request($id){
        $booking = Booking::findOrFail($id);

        return view('admin.bookings.extend', compact('booking'));
    }


    /**
     * Request extend for patient
     * create new patient record using the old patient details
     * create new booking record using the old booking details
     * days is needed for new records
     * new amount is also added
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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


        // now create a new booking record
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
            ->with('success','Booking extended successfully!');
    }


    /**
     * takeover the old booking from where it is left
     * create new booking record with new nurse allotted
     * new booking record will continue from the remaining days of left over booking
     * new nurse attendence will be recorded for the left over days only
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function takeover(Request $request){
        $data = $request->only(['booking_id', 'patient_id', 'nurse']);

        $booking = Booking::findOrFail($data['booking_id']);

        // update the nurse status to not working and set to leave
        Nurse::findOrfail($booking->nurse_id)->update(['status' => 0,
            'is_active' => 0]);

        // update the old  booking status to take over
        $booking->update(['status'=>4]);


        // create the new booking using the old records
        Booking::create(['user_id' => $booking->user_id,
                'patient_id' => $booking->patient_id,
                'nurse_id' => $data['nurse'],
                'total_payment' => $booking->total_payment,
                'due_payment' => $booking->due_payment,
                'remaining_days' => $booking->remaining_days
            ]);

        // update the new alloted nurse status to working
        Nurse::findOrfail($data['nurse'])->update(['status' => 1]);


        $bookings = Booking::all();

        return redirect()
            ->route('admin.book.index', compact('bookings'))
            ->with('success','Booking takeover successfully!');
    }


}
