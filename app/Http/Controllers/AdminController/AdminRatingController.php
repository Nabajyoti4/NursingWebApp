<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class AdminRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|
     */
    public function index()
    {
        //
        $ratings = Rating::all();
        return view('admin.rating.index', compact('ratings'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|
     */
    public function create()
    {
        //
        return view('admin.rating.create');

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
        $data = $request->only('name','star', 'remark', 'photo');

        if ($request->hasFile('photo')) {
//        update if
            $image = $request->photo->store('ratings', 'public');
            $data['photo'] = $image;

        }
        Rating::create($data);

        $ratings = Rating::all();
        return redirect()->route('admin.rating.index', compact('ratings'))
            ->with('success', 'Rating Created');

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
     * @return \Illuminate\Http\Response|
     */
    public function edit($id)
    {
        //
        $rating = Rating::findOrFail($id);
        return view('admin.rating.edit', compact('rating'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response|
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->only('name','star', 'remark', 'photo');

        $rating = Rating::findOrFail($id);

        if ($request->hasFile('photo')) {
//        update if
            Storage::disk('public')->delete($rating->photo);
            $image = $request->photo->store('ratings', 'public');
            $data['photo'] = $image;

        }
        $rating->update($data);

        $ratings = Rating::all();
        return redirect()->route('admin.rating.index', compact('ratings'))
            ->with('success', 'Rating Created');
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
        $rating = Rating::findOrFail($id);
        Storage::disk('public')->delete($rating->photo);
        $rating->delete();
        return redirect()->back()->with('success', 'Rating deleted ');
    }
}
