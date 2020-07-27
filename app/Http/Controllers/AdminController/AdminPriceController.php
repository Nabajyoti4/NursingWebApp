<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Price;
use Illuminate\Http\Request;

class AdminPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|
     */
    public function index()
    {
        //
        $prices = Price::all();
        return view('admin.price.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|
     */
    public function create()
    {
        //
        return view('admin.price.create');
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
        $data = $request->only(['name', 'price', 'timing', 'days', 'period']);

        Price::create($data);
        $prices = Price::all();
        return redirect()
            ->route('admin.price.index', compact('prices'))
            ->with('success', 'Pricing Created');
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
        $price = Price::findOrFail($id);
        return view('admin.price.edit', compact('price'));
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
        $data = $request->only(['name', 'price', 'timing', 'days', 'period']);

        $price = Price::findOrFail($id);
        $price->update($data);
        $prices = Price::all();
        return redirect()
            ->route('admin.price.index', compact('prices'))
            ->with('success', 'Pricing Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|
     */
    public function destroy($id)
    {
        //
        Price::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Deleted');
    }
}
