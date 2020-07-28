<?php

namespace App\Http\Controllers;

use App\Notifications\NurseJoinDisapprove;
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
        $admin = Auth::user();


        // if the admin is super admin
        if ($admin->role == 'super') {
            $candidates = NurseJoinRequest::latest()->get();
            $pcandidates = array();//pending candidates
            $acandidates = array();//approved candidates
            $rcandidates = array();//rejected candidates

            foreach ($candidates as $candidate) {
                if ($candidate->Approval == 2) {
                    array_push($pcandidates, $candidate);
                } elseif ($candidate->Approval == 1) {
                    array_push($acandidates, $candidate);
                } else {
                    array_push($rcandidates, $candidate);
                }
            }
            return view('admin.requests.nurse.index', compact('pcandidates', 'acandidates', 'rcandidates'));


        } else {
            $candidateAll = NurseJoinRequest::latest()->get();
            $pcandidates = array();//pending candidates
            $acandidates = array();//approved candidates
            $rcandidates = array();//rejected candidates

            foreach ($candidateAll as $candidate) {
                $user = User::where('id', $candidate->user_id)->first();
                if (($user->addresses->first()->city) == ($admin->addresses->first()->city)) {
                    if ($candidate->Approval == 2) {
                        array_push($pcandidates, $candidate);
                    } elseif ($candidate->Approval == 1) {
                        array_push($acandidates, $candidate);
                    } else {
                        array_push($rcandidates, $candidate);
                    }
                }
            }

            return view('admin.requests.nurse.index', compact('pcandidates', 'acandidates', 'rcandidates'));
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
        if ($user->permanent_address_id) {
            // search for pending request if email
            if (NurseJoinRequest::all()->where('user_id', $data['user_id'])->isNotEmpty()) {
                // searching for the candidate request in DB
                $candidate = NurseJoinRequest::where('user_id', $data['user_id'])->get()->first();

                // searching if the state is pending
                if ($candidate['Approval'] == 2) {
                    return redirect()->back()->with('info', 'You have already send the request.Your request is in pending state');
                } elseif ($candidate['Approval'] == 0) {
                    return redirect()->back()->with('info', 'Your request has been disapproved Check mail for further details.');
                } else {
                    return redirect()->back()->with('info', 'You are already approved ');
                }

            } else {
                // create if no pending request for particular candidate
                $nurse = NurseJoinRequest::create($data);
                $city = NurseJoinRequest::findOrFail($nurse->id)->first();
                $user = User::where('id', $city->user_id)->get();
                $adminAll = User::where('role', 'admin')->get();

                $admins = array();
                foreach ($adminAll as $admin) {
                    if ($admin->addresses->first()->city == $user->first()->addresses->first()->city) {
                        array_push($admins, $admin);
                    }
                }

                Notification::send($admins, new \App\Notifications\NurseJoinRequest($nurse));

                return redirect()->back()->with('success', 'Your request has been send, We will get back to you shortly!');
            }
        } else {
            return redirect()->back()->with('info_fill', 'Please fill your user profile with address and other information');
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
