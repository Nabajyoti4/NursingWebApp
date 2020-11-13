<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name',
        'email',
        'phone_no',
        'password',
        'role',
        'photo_id',
        'current_address_id',
        'permanent_address_id'
        ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * every user had a current address
     * permanent address
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses(){
        return $this->hasMany(Address::class);
    }

    /**
     * every user has a one profile photo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo(){
        return $this->belongsTo(Photo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function nurse(){
        return $this->hasOne(Nurse::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patient(){
        return $this->hasMany(Patient::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings(){
        return $this->hasMany(Booking::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee(){
        return $this->hasOne(Employee::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(){
        return $this->belongsTo(Role::class);
    }

    /**
     * for address fetch
     * @param $id
     * @return mixed
     */
    public function address($id){
        return Address::findOrFail($id);
    }

    /**
     * get permanent if from user table
     * @param $id
     * @return mixed
     */
    public function getPAddressId($id){
        return User::findOrFail($id)->permanent_address_id;
    }

    /**
     * get the current id from the user table
     * @param $id
     * @return mixed
     */
    public function getCAddressId($id){
        return User::findOrFail($id)->current_address_id;
    }
}
