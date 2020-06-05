<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    //

    protected $fillable = ['user_id',
        'employee_id',
        'qualification_id',
        'is_active',
        'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function nurse_qualification(){
        return $this->hasOne(NurseQualification::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
