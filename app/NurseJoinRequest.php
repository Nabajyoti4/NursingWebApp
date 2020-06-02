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

 

}
