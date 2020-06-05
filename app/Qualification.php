<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    //

    protected $fillable = ['nurse_id',
        'pan_card',
        'voter_card',
        'adhar_card',
        'license_card',
        'qualification',
        'other_qualification'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function nurse(){
        return $this->hasOne(Nurse::class);
    }
}
