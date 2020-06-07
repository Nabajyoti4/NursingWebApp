<?php

namespace App\Http\Controllers;

use App\NurseJoinRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class NurseJoinRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $candidates = NurseJoinRequest::latest()->get();

        return view('admin.requests.nurse.index', compact('candidates'));
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

        $data = $request->all();

        // search for pending request if email
        if(NurseJoinRequest::all()->isNotEmpty())
        {
            // searching for the candidate request in DB
            $candidate = NurseJoinRequest::where('user_id',$data['user_id'])->get()->first();

            // searching if the state is pending
            if ($candidate['Approval'] == 2 ){
                return redirect()->back()->with('pending', 'Your request is still pending wait for Admin approvel');
            }
        }
        else{
            // create if no pending request for particular candidate

            $nurse = NurseJoinRequest::create($data);
            $admin = User::where('role', 'admin')->get();
            Notification::send($admin, new \App\Notifications\NurseJoinRequest($nurse));

            return redirect()->back()->with('success', 'Your request has been send, our team will talk with you shortly!');
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


        Notification::send($user, new \App\Notifications\NurseJoinDisapprove($request));

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
