<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NurseJoinRequest extends Model
{
    //
    protected $fillable = ['user_id',
        'name',
        'email',
        'phone_no',
        'age',
        'Approval'];


    /**
     * return user role
     * @param $id
     * @return mixed
     */
    public function check_role($id){
        $nurse = NurseJoinRequest::findOrFail($id);

        $user = User::where('id' , $nurse->user_id)->get();

        return $user->first()->role;
    }

    public function check($id){

    }

}
