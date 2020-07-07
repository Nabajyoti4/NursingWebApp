<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|
     */
    public function index()
    {
        //

        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|
     */
    public function store(Request $request)
    {
        //
        $data = $request->only(['title', 'details']);

        Service::create($data);

         $services = Service::all();
        return redirect()
            ->route('admin.services.index', compact('services'))
            ->with('success', 'Service Created');
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
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));

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
        //
        $data = $request->only(['title', 'details']);
        
        $service = Service::findOrFail($id)->update($data);
        $services = Service::all();
        return redirect()->route('admin.services.index', compact('services'))->with('success', 'Service Updated');



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
        Service::findOrFail($id)->delete();
        $services = Service::all();
        return redirect()->route('admin.services.index', compact('services'))->with('success', 'Service Deleted');

    }
}
