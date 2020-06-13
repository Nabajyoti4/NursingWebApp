<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'present',
        'absent',
        'booking_id',
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }


}
