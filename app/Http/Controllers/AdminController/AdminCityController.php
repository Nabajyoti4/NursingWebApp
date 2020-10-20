<?php

namespace App\Http\Controllers\AdminController;

use App\City;
use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Http\Request;

class AdminCityController extends Controller
{
    //

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $cities = City::all();
        return view('admin.city.index', compact('cities'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin.city.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $data = $request->only('city');
        $data['city']=strtolower($data['city']);
        City::create($data);
        return redirect()->route('admin.city.index')->with('success', 'District Created');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
        $city = City::findOrFail($id);
        return view('admin.city.edit', compact('city'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id){
        $data = $request->only('city');
        $state = City::findOrFail($id);
        $state->update($data);
        return redirect()->route('admin.city.index')->with('success', 'District Updated');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id){
        City::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'District deleted');
    }
}
