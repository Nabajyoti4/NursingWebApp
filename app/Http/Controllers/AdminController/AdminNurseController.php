<?php

namespace App\Http\Controllers\AdminController;

use App\Address;
use App\City;
use App\Http\Controllers\Controller;
use App\Nurse;
use App\Photo;
use App\Qualification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminNurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $search = request()->get('nurse');
        $admin = Auth::user();
        $cities = City::all();



        if ($search){
            $nurses = Nurse::where("employee_id","LIKE","%{$search}%")->get();

            if($admin->role == 'super'){
                return view('admin.nurses.index', compact('nurses', 'cities'));
            }else{
                if($nurses->isEmpty()){
                    return view('admin.nurses.index', compact('nurses', 'cities'));
                }else{
                    $user = User::where('id', $nurses->first()->user_id)->first();

                    if (($user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        return view('admin.nurses.index', compact('nurses', 'cities'));
                    }else{
                        $nurses = collect([]);
                        return view('admin.nurses.index', compact('nurses', 'cities'));
                    }
                }
            }
        }
        else{
            if($admin->role == 'super'){
                $nurses = Nurse::all();
                return view('admin.nurses.index', compact('nurses', 'cities'));
            }else{
                $nurseAll = Nurse::all();
                $nurses = array();

                foreach ($nurseAll as $nurse) {
                    if (($nurse->user->addresses->first()->city ) == ($admin->addresses->first()->city)) {
                        array_push($nurses, $nurse);
                    }
                }
                return view('admin.nurses.index', compact('nurses', 'cities'));
            }

        }


    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter(Request $request){
        $data = $request->only('city');
        $cities = City::all();

        if($data['city'] == null){
            $nurses = Nurse::all();
            return view('admin.nurses.index', compact('nurses', 'cities'));
        }

        $nurses = (new \App\Nurse)->filter($data['city']);
        return view('admin.nurses.index', compact('nurses', 'cities'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
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


        // reteive the values from request
        $data = $request->only(['age','identification', 'address', 'education', 'other']);

        // create a employee id for nurse
        $last = Nurse::all()->last();
       if($last){
           $emp_id = 'N' . (1001 + $last->id);
        }else{
           $emp_id = 'N' . (1001);
       }

       // genrate a unique id to store the image of each user
        $directoy = (string) Str::uuid();

        // store the image in storage
        $identification = $data['identification']->store($directoy, 'public');
        $address = $data['address']->store($directoy, 'public');

       // create a qualification details record for the new nurse in qualification table
       $qualification = Qualification::create(['identification' => $identification,
           'address' => $address,
           'education' => $data['education'],
           'other' => $data['other']]);

       $nurse_age = $data['age'];

       // create the new nurse record
       $nurse = Nurse::create(['user_id' => $user_id,
           'employee_id' => $emp_id,
           'age' => $nurse_age,
           'qualification_id' => $qualification->id,
           ]);

        // update the user role to nurse
        $user->update(['role' => 'nurse']);


      Notification::send($user, new \App\Notifications\NewNurse($nurse));

       $nurses = Nurse::all();
       return redirect()
           ->route('admin.nurse.index', compact('nurses'))
           ->with('success','Nurse Created  successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $nurse = Nurse::findOrFail($id);
        return view('admin.nurses.show', compact('nurse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
        $nurse = Nurse::findOrFail($id);
        $user =User::findOrFail($nurse->user_id);
        $cities = City::all();
        $permanent_add=Address::where('id',$user->permanent_address_id)->get()->first();
        $current_add=Address::where('id',$user->current_address_id)->get()->first();
        return view('admin.nurses.edit', compact('nurse', 'cities','permanent_add','current_add'));
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
        $cities = City::all();
        $permanent_add=Address::where('id',$user->permanent_address_id)->get()->first();
        $current_add=Address::where('id',$user->current_address_id)->get()->first();
        return view('admin.nurses.create', compact('user','current_add','permanent_add','cities'));
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
            'identification', 'address', 'education', 'other','permanent']);


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
                'city' => strtolower($data['current_city']),
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



        // find the qualification details of nurse
        $qualification = Qualification::findOrFail($nurse->qualification_id);
        $path = $qualification->identification;
        $directory = explode("/", $path);


        // now check for documents change
        if ($request->hasFile('identification')) {
                //find the all document
                $identification = $data['identification']->store($directory[0], 'public');

                Storage::disk('public')->delete($nurse->qualification->identification);
                $qualification->update(['identification'=>$identification]);
        }

        if ($request->hasFile('address')) {
            //find the all document
            $address = $data['address']->store($directory[0], 'public');

            Storage::disk('public')->delete($nurse->qualification->address);
            $qualification->update(['address'=>$address]);
        }



        $user->update(['name' => $data['name'],
            'phone_no' => $data['phone_no']]);


         $nurse->update(['age' => $data['age'],
            'is_active' => $data['active'],
             'permanent'=>$data['permanent']]);


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

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makePermanent($id){
        Nurse::findOrFail($id)->update(['permanent'=>1]);
        session()->flash('success', 'Nurse is permanent Now!');
        return redirect()->back();
    }
}
