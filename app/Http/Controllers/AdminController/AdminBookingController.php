<?php

namespace App\Http\Controllers\AdminController;

use App\Address;
use App\Attendance;
use App\Booking;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Notifications\NurseBooked;
use App\Nurse;
use App\Patient;
use App\Service;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
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
        $search = request()->get('booking');
        $admin = Auth::user();


        if ($search){
            $bookings = Booking::where("id","LIKE","%{$search}%")->get();

            if($admin->role == 'super'){
                return view('admin.bookings.search', compact('bookings'));
            }else{
                if($bookings->isEmpty()) {
                    return view('admin.bookings.search', compact('bookings'));
                    // get the address of the requested PATIENT
                    // check f the address of the candidate is same as admin
                }else{
                        if (($bookings->first()->patient->getAddress()) == ($admin->addresses->first()->city)) {
                            return view('admin.bookings.search', compact('bookings'));
                        } else {
                            $bookings = collect([]);
                            return view('admin.bookings.search', compact('bookings'));
                        }
                    }
                }
        }

        else{
            if($admin->role == 'super'){
                $bookingAll = Booking::latest()->get();
                $pbookings = array();
                $cbookings = array();
                $rbookings = array();
                $tbookings = array();
                $abookings = array();

                foreach ($bookingAll as $booking) {
                        if($booking->status == 0){
                            array_push($rbookings, $booking);
                        }elseif ($booking->status == 1){
                            array_push($cbookings, $booking);
                        }elseif ($booking->status == 2){
                            array_push($pbookings, $booking);
                        }elseif ($booking->status == 3){
                            array_push($abookings, $booking);
                        }else{
                            array_push($tbookings, $booking);
                        }
                }
                return view('admin.bookings.index', compact('tbookings','cbookings', 'rbookings','abookings', 'pbookings'));

            }else {
                $bookingAll = Booking::latest()->get();
                $pbookings = array();
                $cbookings = array();
                $rbookings = array();
                $tbookings = array();
                $abookings = array();

                foreach ($bookingAll as $booking) {
                    if (($booking->patient->getAddress()) == ($admin->addresses->first()->city)) {
                        if($booking->status == 0){
                            array_push($rbookings, $booking);
                        }elseif ($booking->status == 1){
                            array_push($cbookings, $booking);
                        }elseif ($booking->status == 2){
                            array_push($pbookings, $booking);
                        }elseif ($booking->status == 3){
                            array_push($abookings, $booking);
                        }else{
                            array_push($tbookings, $booking);
                        }
                    }
                }
                return view('admin.bookings.index', compact('tbookings','cbookings', 'rbookings','abookings', 'pbookings'));
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
        $nurses = Nurse::select('*')
            ->where('is_active', 1)
            ->where('status', 0)
            ->get();



//        $nurses = array();
//        foreach ($nursesAll as $nurse) {
//            if ((Address::findOrFail($nurse->user->current_address_id)->city) === ($patient->getAddress())) {
//                array_push($nurses, $nurse);
//            }
//        }

        return view('admin.bookings.create', compact('patient', 'nurses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        //use request only to fetch the required data
        $data = $request->only(['patient_id','total_payment','start_date', 'due_date','due_payment','nurse','payment_mode']);

        //fetch user_id from patient
        $patient = Patient::findOrFail($data['patient_id']);


        // create a serial number for receipt
        if (Booking::all()->last()) {
            $last = Booking::all()->last();
            $serial = (1 + $last->serial);
        } else {
            $serial = (101);
        }

        //create a money receipt serial number
        if (Booking::all()->last()) {
            $last = Booking::all()->last();
            $money_serial = (601 + $last->id);
        } else {
            $money_serial = (601);
        }


        $booking = Booking::create(['user_id' => $patient->user->id,
                        'patient_id' => $data['patient_id'],
                        'serial' => $serial,
                        'serial_money' => $money_serial,
                        'start_date' => $data['start_date'],
                        'due_date' => $data['due_date'],
                        'nurse_id' => $data['nurse'],
                        'total_payment' => $data['total_payment'],
                        'due_payment' => $data['due_payment'],
                        'remaining_days' => $patient->days,
                        'payment_mode'=>$data['payment_mode'],
                        ]
                        );

        //attach booking with nurse
        $booking->nurses()->attach($data['nurse']);

        // get the nurse and update the status to working 1
        Nurse::findOrfail($data['nurse'])->update(['status' => 1]);



        $bookings = Booking::all();
        return redirect()
            ->route('admin.book.index', compact('bookings'))
            ->with('success','Booking done successfully!');

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function booking_edit($id){
        $booking = Booking::findOrFail($id);
        return view('admin.bookings.edit', compact('booking'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function booking_update(Request $request, $id){
        $data = $request->only('total_payment', 'due_payment', 'start_date', 'due_date', 'days','payment_mode');

        $booking = Booking::findOrFail($id);
        $patient = Patient::findOrFail($booking->patient->id);

        $booking['total_payment'] = $data['total_payment'];
        $booking['due_payment'] =$data['due_payment'];
        $booking['start_date'] =$data['start_date'];
        $booking['due_date'] = $data['due_date'];
        $booking['payment_mode'] = $data['payment_mode'];

        //calculate remaining days
        if($patient['days'] !== $data['days']) {
            $booking['remaining_days'] = ($data['days']) - ($booking->patient->days - $booking->remaining_days);
        }

        $patient['days'] = $data['days'];

        $booking->save();
        $patient->save();

        return redirect()->route('admin.book.index')
            ->with('success', 'Booking details updated');

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
     * @return RedirectResponse
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|RedirectResponse|\Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $data = $request->only(['action']);


        $value = $data['action'];

        // 0 reject
        if($value == 0){
            $nurse = Nurse::findOrFail($booking->nurse_id);
            $nurse->status = 0;
            $booking->status = 0;
            $booking->save();
            $nurse->save();
            return redirect()->back()->with('success', 'Booking cancelled');
        }

        // 4 takeover action
        elseif ($value == 4){

            $patient = Patient::findOrFail($booking->patient_id);

            // fetch the other nurse who are active
            $nurses = Nurse::select('*')
                         ->where('is_active', 1)
                         ->where('status', 0)
                         ->get();

            //  find the nurse same as patient address
//            $nurses = array();
//            foreach ($nursesAll as $nurse) {
//                if (($nurse->user->addresses->first()->city) === ($patient->getAddress())) {
//                    array_push($nurses, $nurse);
//                }
//            }


            return view('admin.bookings.takeover', compact('booking', 'nurses'));
        }
        // 1 complete
        else{
            $nurse = Nurse::findOrFail($booking->nurse_id);
            $nurse->status = 0;
            $booking->status = 1;
            $booking->save();
            $nurse->save();
            return redirect()->back()->with('success', 'Booking Completed');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function request($id){
        $booking = Booking::findOrFail($id);
        $services = Service::all();
        $nurses = Nurse::select('*')
            ->where('is_active', 1)
            ->where('status', 0)
            ->get();
        return view('admin.bookings.extend', compact('booking', 'nurses', 'services'));
    }


    /**
     * Request extend for patient
     * create new patient record using the old patient details
     * create new booking record using the old booking details
     * days is needed for new records
     * new amount is also added
     * @param Request $request
     * @return RedirectResponse
     */
    public function extend(Request $request){
        //use request only to fetch the required data
        $data = $request->only(['patient_id','total_payment','due_payment','nurse', 'shift', 'service_id','days', 'start_date', 'due_date']);

        //fetch user_id from patient
        $old_patient = Patient::findOrFail($data['patient_id']);


        $last = Patient::all()->last();
        if($last){
            $patient_id = 'P' . (1001 + $last->id);
        }else{
            $patient_id = 'P' . (1001);
        }

        // create a new patient
        $patient = Patient::create(['user_id' =>  $old_patient->user->id,
            'patient_id' => $patient_id,
            'patient_name' => $old_patient->patient_name,
            'photo_id' => $old_patient->photo_id,
            'phone_no' => $old_patient->phone_no,
            'age' => $old_patient->age,
            'gender' => $old_patient->gender,
            'address_id' => $old_patient->address_id,
            'family_members' => $old_patient->family_members,
            'guardian_name' => $old_patient->guardian_name,
            'relation_guardian' => $old_patient->relation_guardian,
            'shift' => $data['shift'],
            'days' => $data['days'],
            'status' => 1,
            'service_id' => $data['service_id'],
            'patient_history' => $old_patient->patient_history,
            'patient_doctor' => $old_patient->patient_doctor
        ]);



        // create a serial number for receipt
        if (Booking::all()->last()) {
            $last = Booking::all()->last();
            $serial = (1 + $last->serial);
        } else {
            $serial = (101);
        }

        //create a money receipt serial number
        if (Booking::all()->last()) {
            $last = Booking::all()->last();
            $money_serial = (601 + $last->id);
        } else {
            $money_serial = (601);
        }

        $booking = Booking::create(['user_id' => $patient->user->id,
                'patient_id' => $patient->id,
                'serial' => $serial,
                'serial_money' => $money_serial,
                'start_date' => $data['start_date'],
                'due_date' => $data['due_date'],
                'nurse_id' => $data['nurse'],
                'total_payment' => $data['total_payment'],
                'due_payment' => $data['due_payment'],
                'remaining_days' => $patient->days]
        );

        $booking->nurses()->attach($data['nurse']);
        // get the nurse and update the status to working 1
        Nurse::findOrfail($data['nurse'])->update(['status' => 1]);

        $bookings = Booking::all();
        return redirect()
            ->route('admin.book.index', compact('bookings'))
            ->with('success','Booking extended successfully!');
    }


    /**
     * takeover the old booking from where it is left
     * create new booking record with new nurse allotted
     * new booking record will continue from the remaining days of left over booking
     * new nurse attendance will be recorded for the left over days only
     * @param Request $request
     * @return RedirectResponse
     */
    public function takeover(Request $request){
        $data = $request->only(['booking_id', 'patient_id', 'nurse']);

        $booking = Booking::findOrFail($data['booking_id']);



        // update the nurse status to not working and set to leave
        $old_nurse = Nurse::findOrFail($booking->nurse_id);
        $old_nurse['status'] = 0;
        $old_nurse['is_active'] = 0;
        $old_nurse->save();

        $booking['nurse_id'] = $data['nurse'];


        // update the new allotted nurse status to working
        Nurse::findOrFail($data['nurse'])->update(['status' => 1]);


        $verify = DB::table('booking_nurse')
            ->where('booking_id', $booking->id)
            ->where('nurse_id', $data['nurse'])
            ->first();


        if(!$verify){
            $booking->nurses()->attach($data['nurse']);
        }



        //save booking
        $booking->save();





        $bookings = Booking::all();

        return redirect()
            ->route('admin.book.index', compact('bookings'))
            ->with('success','Booking takeover successfully!');
    }


}
