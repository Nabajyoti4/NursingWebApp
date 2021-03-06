<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable = ['user_id',
        'patient_name','patient_id', 'photo_id', 'phone_no', 'age',
        'gender', 'address_id', 'family_members', 'guardian_name',
        'relation_guardian', 'shift', 'days', 'service_id',
        'patient_history', 'patient_doctor', 'status','office_location'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reject()
    {
        return $this->hasOne(Reject::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return Address::findOrFail($this->address_id)->city;
    }


    /**
     * @return mixed
     */
    public function getFullAddress(){
        return Address::findOrFail($this->address_id);
    }


}
