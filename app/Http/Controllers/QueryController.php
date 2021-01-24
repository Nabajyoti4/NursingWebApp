<?php

namespace App\Http\Controllers;

use App\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\CrudOperationBindable;

class QueryController extends Controller
{
    //
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $data = $request->only(['name', 'phone', 'email', 'query', 'city']);

        Query::create($data);

        return redirect()->back()->with('success', 'Query Submitted');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $querieAll = Query::latest()->get();
        $admin = Auth::user();

        $queries = array();

    if(Auth::user()->role === 'super'){
        $queries=Query::latest()->get();
       return view('admin.query.index', compact('queries'));
    }
        foreach ($querieAll as $query) {
            if ($query->city == ($admin->addresses->first()->city)) {
                array_push($queries, $query);
            }
        }

        return view('admin.query.index', compact('queries'));
    }

    public function update($id){
        $query = Query::findOrFail($id);
        $query['status'] = 1;
        $query->save();
        return redirect()->back()->with('success', 'Query Responded');

    }
    public function destory($id){
        Query::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Query Deleted');

    }

}
