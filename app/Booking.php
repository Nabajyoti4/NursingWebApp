<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = ['user_id',
        'patient_id',
        'nurse_id',
        'status',
        'due_payment',
        'serial',
        'serial_money',
        'total_payment',
        'remaining_days'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nurse(){
        return $this->belongsTo(Nurse::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendance(){
        return $this->hasMany(Attendance::class);
    }

    public function getAttendanceHalf()
    {
        return (Patient::findOrFail($this->patient_id)->days)/2;
    }

}
