<?php

namespace App\Http\Controllers\AdminController;

use App\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        /**
         * Search variable check for serach request in request parameter
         * if found return the search results
         * else return all users from db
         */
        $search = request()->get('searchUser');


        if ($search){
            $users = User::where("name","LIKE","%{$search}%")->get();

        }
        else{
            $users = User::latest()->get();

        }


        return view('admin.users.index', compact('users'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        echo "Show page admin side say banna hai";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, $id)
    {
        //
        $data = $request->only(['name','phone_no', 'image','current_city',
            'current_landmark','current_street','current_post','current_country',
            'current_pincode','current_police','current_state','permanent_city',
            'permanent_landmark','permanent_street','permanent_post','permanent_country',
            'permanent_pincode','permanent_police','permanent_state']);

        $user = User::findOrfail($id);

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


        return redirect(route('admin.users.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
