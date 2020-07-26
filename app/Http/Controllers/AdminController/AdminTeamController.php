<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Team::paginate(15);
        return view('admin.team.index',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['name','designation','photo']);
        if ($request->hasFile('photo')) {
            $image= $request->photo->store('team','public');
            $data['photo']=$image;
        }
        Team::create($data);
        return redirect()->route('admin.teams.index')->with('success','Team Member Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Team::findOrFail($id);
        return view('admin.team.edit',compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $member = Team::findOrFail($id);
        $data = $request->only(['name','designation']);
        if ($request->hasFile('photo')) {

            //        delete old image
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
            $image= $request->photo->store('team','public');
            $data['photo']=$image;
        }

        $member->update($data);
        return redirect()->route('admin.teams.index')->with('success','Team Member Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member= Team::findOrFail($id);

        Storage::disk('public')->delete($member->photo);
        $member->delete();
        return redirect()->route('admin.teams.index')->with('success','Team Member Deleted!');
    }
}
