<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $fillable = ['title', 'details', 'list', 'cover'];

    public  function patient(){
        $this->hasOne(Patient::class);
    }
}
