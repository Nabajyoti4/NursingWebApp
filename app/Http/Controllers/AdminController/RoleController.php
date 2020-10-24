<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin.role.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $data = $request->only('role');
        $data['role']=strtolower($data['role']);
        Role::create($data);
        return redirect()->route('admin.role.index')->with('success', 'Role Created');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
    $role = Role::findOrFail($id);
    return view('admin.role.edit', compact('role'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id){
        $data = $request->only('role');
        $role = Role::findOrFail($id);
        $role->update($data);
        return redirect()->route('admin.role.index')->with('success', 'Role Updated');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id){
        $role = Role::findOrFail($id);

        $user = User::where('role', $role->id)->get();

        if($user->isNotEmpty()){
            return redirect()->back()->with('warning', 'Role Assigned to users , cannot delete');
        }

        $role->delete();
        return redirect()->back()->with('success', 'Role deleted');
    }
}
