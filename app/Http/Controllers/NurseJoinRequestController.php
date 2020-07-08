<?php

namespace App\Http\Controllers;

use App\Notifications\NurseJoinDisapprove;
use App\Nurse;
use App\NurseJoinRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


class NurseJoinRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $search = request()->get('candidate');
        $admin = Auth::user();

        if ($search){

            $candidates = NurseJoinRequest::where("name","LIKE","%{$search}%")->get();


            if($admin->role == 'super'){
                return view('admin.requests.nurse.index', compact('candidates'));
            }
            else{
                // check if the collection have any data
                if($candidates->isEmpty()){
                    return view('admin.requests.nurse.index', compact('candidates'));
                }else{
                    // get the address of the requested nurse from user
                    $user = User::where('id', $candidates->first()->user_id)->first();

                    // check if the address of the candidate is same as admin
                    if (($user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        return view('admin.requests.nurse.index', compact('candidates'));
                    }else{
                        $candidates = collect([]);
                        return view('admin.requests.nurse.index', compact('candidates'));
                    }
                }
            }


        }

        else{
            // if the admin is super admin
            if($admin->role == 'super'){
                $candidates = NurseJoinRequest::latest()->get();
                return view('admin.requests.nurse.index', compact('candidates'));

            }else{
                $candidateAll = NurseJoinRequest::latest()->get();
                $candidates = array();

                foreach ($candidateAll as $candidate) {
                    $user = User::where('id', $candidate->user_id)->first();
                    if (($user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                        array_push($candidates, $candidate);
                    }
                }

                return view('admin.requests.nurse.index', compact('candidates'));
            }


        }


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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $data = $request->only(['user_id',
        'name',
        'email',
        'phone_no',
        'age']);

        $user = Auth::user();

        // check if the address fields are not empty
        if($user->permanent_address_id){
            // search for pending request if email
            if(NurseJoinRequest::all()->where('user_id',$data['user_id'])->isNotEmpty())
            {
                // searching for the candidate request in DB
                $candidate = NurseJoinRequest::where('user_id',$data['user_id'])->get()->first();

                // searching if the state is pending
                if ($candidate['Approval'] == 2 ){
                    return redirect()->back()->with('info', 'You have already send the request.Your request is in pending state');
                }
                elseif ($candidate['Approval']==0){
                    return redirect()->back()->with('info', 'Your request has been disapproved Check mail for further details.');
                }
                else{
                    return redirect()->back()->with('info', 'You are already approved Check mail');
                }

            }
            else{
                // create if no pending request for particular candidate
                $nurse = NurseJoinRequest::create($data);

                $admin = User::where('role', 'admin')->get();

                Notification::send($admin, new \App\Notifications\NurseJoinRequest($nurse));

                return redirect()->back()->with('success', 'Your request has been send, We will get back to you shortly!');
            }
        }else{
            return redirect()->back()->with('info', 'Please fill your user profile with address and other informations');
        }




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


    }


    public function approve(NurseJoinRequest $candidate)
    {
        $candidate->Approval = 1;
        $candidate->save();
        session()->flash('success', 'Candidated Approved');
        return redirect()->back();
    }


    public function disapprove(Request $request, $id)
    {


        $candidate = NurseJoinRequest::findOrFail($id);
        $user = User::findOrFail($candidate->user_id);


        Notification::send($user, new NurseJoinDisapprove($request));

        $candidate->Approval = 0;
        $candidate->save();
        session()->flash('success', 'Candidated Disapproved');
        return redirect()->back();
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
