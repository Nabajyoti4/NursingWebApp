<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    //

    protected $fillable = ['nurse_id',
        'identification',
        'address'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function nurse(){
        return $this->hasOne(Nurse::class);
    }
}
