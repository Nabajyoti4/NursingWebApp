<?php

namespace App\Http\Controllers\User;

use App\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::findOrFail(Auth::user()->id);


        return view('users.index', compact('user'));
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
        $user = User::findOrFail(Auth::user()->id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
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
            $permanent_address = Address::findOrfail($user->permanent_address_id);

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

            $current_address = Address::findOrfail($user->current_address_id);
            $current_address->update(['user_id' => $user->id,
                'city' => $data['current_city'],
                'state' => $data['current_state'],
                'pin_code' => $data['current_pincode'],
                'country' => $data['current_country'],
                'landmark' => $data['current_landmark'],
                'street' => $data['current_street'],
                'police_station' => $data['current_police'],
                'post_office' => $data['current_post']

            ]);


        }else{

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

            $current_address = Address::create(['user_id' => $user->id,
                'city' => $data['current_city'],
                'state' => $data['current_state'],
                'pin_code' => $data['current_pincode'],
                'country' => $data['current_country'],
                'landmark' => $data['current_landmark'],
                'street' => $data['current_street'],
                'police_station' => $data['current_police'],
                'post_office' => $data['current_post']

            ]);




            // get the currently created addresses id and store in user model
            $user['current_address_id'] = $current_address->id;
            $user['permanent_address_id'] = $permanent_address->id;
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

            }
        }



        $user->update($data);


        return redirect(route('users.index'));

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
