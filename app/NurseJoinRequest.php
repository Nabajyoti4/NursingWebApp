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

    public function approved(NurseJoinRequest $candidate){
        $candidate->Approval='Approved';
        $candidate->save();
        session()->flash('success','Candidated Approved');
        return redirect()->back();
    }
    public function disapproved(NurseJoinRequest $candidate){
        $candidate->Approval='Disapproved';
        $candidate->save();
        session()->flash('success','Candidated Disapproved');
        return redirect()->back();
    }

}
