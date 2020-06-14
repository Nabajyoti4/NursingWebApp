<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'present',
        'booking_id',
        'photo'
    ];

    public function booking(){
        return $this->hasMany(Booking::class);
    }


}
