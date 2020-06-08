<?php

namespace App\Http\Controllers\AdminController;

use App\Address;
use App\Http\Controllers\Controller;
use App\Nurse;
use App\Photo;
use App\Qualification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminNurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $nurses = Nurse::all();

        return view('admin.nurses.index', compact('nurses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.nurses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //retireve user id from request
        $user_id = $request->user_id;

        //find the user fro user model
        $user = User::findOrFail($user_id);

        // update the user role to nurse
        $user->update(['role' => 'nurse']);

        // reteive the values from request
        $data = $request->only(['age','pan_image', 'voter_image', 'adhar_image', 'license_image','qualification', 'other_qualification']);

        // create a employee id for nurse
        $last = Nurse::all()->last();
       if($last){
           $emp_id = 'E' . (1001 + $last->id);
        }else{
           $emp_id = 'E' . (1001);
       }

       // genrate a unique id to store the image of each user
        $directoy = (string) Str::uuid();

        // store the image in storage
        $pan = $data['pan_image']->store($directoy, 'public');
        $voter = $data['voter_image']->store($directoy, 'public');
        $adhar = $data['adhar_image']->store($directoy, 'public');
        $license = $data['license_image']->store($directoy, 'public');
        $qualification= $data['qualification']->store($directoy, 'public');
        $other_qualification = $data['other_qualification']->store($directoy, 'public');


       // create a qualification details record for the new nurse in qualification table
       $qualification = Qualification::create(['pan_card' => $pan,
           'voter_card' => $voter,
           'adhar_card' => $adhar,
           'license_card' => $license,
           'qualification' => $qualification,
           'other_qualification' => $other_qualification]);

       $nurse_age = $data['age'];

       // create the new nurse record
       Nurse::create(['user_id' => $user_id,
           'employee_id' => $emp_id,
           'age' => $nurse_age,
           'qualification_id' => $qualification->id,
           ]);

       $nurses = Nurse::all();
       return redirect()
           ->route('admin.nurse.index', compact('nurses'))
           ->with('success','Nurse Created  successfully!');





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
        $nurse = Nurse::findOrFail($id);
        return view('admin.nurses.edit', compact('nurse'));
    }


    /**
     * to create new nurse with user data
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function join($id)
    {
        //
        $user = User::findOrFail($id);
        return view('admin.nurses.create', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // fields which are needed
        $data = $request->only(['name','phone_no','active', 'age','image','current_city',
            'current_landmark','current_street','current_post','current_country',
            'current_pincode','current_police','current_state','permanent_city',
            'permanent_landmark','permanent_street','permanent_post','permanent_country',
            'permanent_pincode','permanent_police','permanent_state',
            'pan_image', 'voter_image', 'adhar_image', 'license_image','qualification', 'other_qualification']);


        // find the nurse using the id
        $nurse = Nurse::findOrFail($id);

        // get the user data of nurse
        $user = User::findOrFail($nurse->user->id);

        // update the permanent and current address
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


        // now check if the profile image is changed
        if ($request->hasFile('image')) {
            //update if
            $image = $request->image->store('users', 'public');

           // delete old image
            if ($user->photo_id) {
                $photo =Photo::findOrFail($user->photo_id);
                Storage::disk('public')->delete($user->photo->photo_location);
                $photo->update(['photo_location'=>$image]);
            } else {
                $photo = Photo::create(['photo_location' => $image]);
                $user['photo_id'] = $photo->id;

            }
        }



        // find the qualification deatils of nurse
        $qualification = Qualification::findOrFail($nurse->qualification_id);
        $path = $qualification->pan_card;
        $directory = explode("/", $path);


        // now check for documents change
        if ($request->hasFile('pan_image')) {
                //find the all document
                $pan_image = $data['pan_image']->store($directory[0], 'public');

                Storage::disk('public')->delete($nurse->qualification->pan_card);
                $qualification->update(['pan_card'=>$pan_image]);
        }

        if ($request->hasFile('voter_image')) {
            //find the all document
            $voter_image = $data['voter_image']->store($directory[0], 'public');

            Storage::disk('public')->delete($nurse->qualification->voter_card);
            $qualification->update(['voter_card'=>$voter_image]);
        }

        if ($request->hasFile('adhar_image')) {
            //find the all document
            $adhar_image = $data['adhar_image']->store($directory[0], 'public');

            Storage::disk('public')->delete($nurse->qualification->adhar_card);
            $qualification->update(['adhar_card'=>$adhar_image]);
        }

        if ($request->hasFile('license_image')) {
            //find the all document
            $license_image = $data['license_image']->store($directory[0], 'public');

            Storage::disk('public')->delete($nurse->qualification->license_card);
            $qualification->update(['license_card'=>$license_image]);
        }

        if ($request->hasFile('qualification')) {
            //find the all document
            $qual = $data['qualification']->store($directory[0], 'public');

            Storage::disk('public')->delete($nurse->qualification->qualification);
            $qualification->update(['qualification'=>$qual]);
        }

        if ($request->hasFile('other_qualification')) {
            //find the all document
            $other_qual = $data['other_qualification']->store($directory[0], 'public');

            Storage::disk('public')->delete($nurse->qualification->other_qualification);
            $qualification->update(['other_qualification'=>$other_qual]);
        }


        $user->update(['name' => $data['name'],
            'phone_no' => $data['phone_no']]);


         $nurse->update(['age' => $data['age'],
            'is_active' => $data['active']]);


        $nurses = Nurse::all();
        return redirect()
            ->route('admin.nurse.index', compact('nurses'))
            ->with('success','Nurse Updated successfully!');

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
