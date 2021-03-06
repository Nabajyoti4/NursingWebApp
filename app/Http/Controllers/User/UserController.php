<?php

namespace App\Http\Controllers\User;

use App\Address;
use App\Attendance;
use App\Booking;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Patient;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //
        $user = User::findOrFail(Auth::user()->id);
        $patients = Patient::where('user_id', Auth::user()->id)->get();
        $bookings = Booking::where('user_id', Auth::user()->id)->get();
        $permanent_add=Address::where('id',$user->permanent_address_id)->get()->first();
        $current_add=Address::where('id',$user->current_address_id)->get()->first();

        return view('users.index', compact('user','patients','bookings','permanent_add','current_add'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return User[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function create()
    {
        //
        return User::all();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail(Auth::user()->id);
        $cities = City::all();
        $permanent_add=Address::where('id',$user->permanent_address_id)->get()->first();
        $current_add=Address::where('id',$user->current_address_id)->get()->first();
        return view('users.edit', compact('user', 'cities','permanent_add','current_add'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(UpdateProfileRequest $request, $id)
    {
        //for form forgery security purpose
        $data = $request->only(['name','phone_no', 'image','current_city',
              'current_landmark','current_street','current_post','current_country',
              'current_pincode','current_police','current_state','permanent_city',
              'permanent_landmark','permanent_street','permanent_post','permanent_country',
              'permanent_pincode','permanent_police','permanent_state']);

        $user = Auth::user();

        /**
         * check if user have a current and permanent address
         */
        if($user->permanent_address_id){
            $permanent_address = Address::findOrFail($user->permanent_address_id);

            $permanent_address->update(['user_id' => $user->id,
                'city' => $data['permanent_city'],
                'state' => $data['permanent_state'],
                'pin_code' => $data['permanent_pincode'],
                'country' => $data['permanent_country'],
                'landmark' => $data['permanent_landmark'],
                'street' => $data['permanent_street'],
                'police_station' => $data['permanent_police'],
                'post_office' => $data['permanent_post']
            ]);

            $current_address = Address::findOrFail($user->current_address_id);
            $current_address->update(['user_id' => $user->id,
                'city' => strtolower($data['current_city']),
                'state' => $data['current_state'],
                'pin_code' => $data['current_pincode'],
                'country' => $data['current_country'],
                'landmark' => $data['current_landmark'],
                'street' => $data['current_street'],
                'police_station' => $data['current_police'],
                'post_office' => $data['current_post']

            ]);



        }else{
            $current_address = Address::create(['user_id' => $user->id,
                'city' => strtolower($data['current_city']),
                'state' => $data['current_state'],
                'pin_code' => $data['current_pincode'],
                'country' => $data['current_country'],
                'landmark' => $data['current_landmark'],
                'street' => $data['current_street'],
                'police_station' => $data['current_police'],
                'post_office' => $data['current_post']

            ]);
            $permanent_address = Address::create(['user_id' => $user->id,
                'city' => $data['permanent_city'],
                'state' => $data['permanent_state'],
                'pin_code' => $data['permanent_pincode'],
                'country' => $data['permanent_country'],
                'landmark' => $data['permanent_landmark'],
                'street' => $data['permanent_street'],
                'police_station' => $data['permanent_police'],
                'post_office' => $data['permanent_post']

            ]);



            // get the currently created addresses id and store in user model
            $user['current_address_id'] = $current_address->id;
            $user['permanent_address_id'] = $permanent_address->id;

            $user->save();
        }



        if ($request->hasFile('image')) {
//        update if
            $image = $request->image->store('users', 'public');

//        delete old image
            if ($user->photo_id) {
                $photo =Photo::findOrFail($user->photo_id);
                Storage::disk('public')->delete($user->photo->photo_location);
                $photo->update(['photo_location'=>$image]);
            } else {
                $photo = Photo::create(['photo_location' => $image]);
                $user['photo_id'] = $photo->id;
                $user->save();

            }
        }





        if ($user->role === "nurse"){
            return redirect(route('nurse.index'))->with('success','Details Updated successfully!');
        }
        return redirect(route('users.index'))->with('success','Details Updated successfully!');

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function booking($id){
        $book = Booking::findOrFail($id);
        $attendances = Attendance::where('booking_id',$book->id)->latest()->get();
        return view('bookings.show', compact('book', 'attendances'));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function receipt($id){
        $patient = Patient::findOrFail($id);
        return view('bookings.receipt', compact('patient'));
    }
}
