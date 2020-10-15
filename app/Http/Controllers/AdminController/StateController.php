<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    //
    //

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $states = State::all();
        return view('admin.state.index', compact('states'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin.state.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $data = $request->only('state');
        State::create($data);
        return redirect()->route('admin.state.index')->with('success', 'District Created');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
        $state = State::findOrFail($id);
        return view('admin.state.edit', compact('state'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id){
        $data = $request->only('state');
        $state = State::findOrFail($id);
        $state->update($data);
        return redirect()->route('admin.state.index')->with('success', 'District Updated');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id){
        State::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'District deleted');
    }

}
