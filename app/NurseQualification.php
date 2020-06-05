<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NurseQualification extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nurse(){
        return $this->belongsTo(Nurse::class);
    }
}
