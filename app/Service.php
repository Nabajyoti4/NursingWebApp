<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $fillable = ['title', 'details'];

    public  function patient(){
        $this->hasOne(Patient::class);
    }
}
