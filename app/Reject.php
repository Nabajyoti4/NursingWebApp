<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reject extends Model
{
    //

    protected $fillable = ['patient_id',
        'tag',
        'reason'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
