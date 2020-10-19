<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $guarded = [];

    /**
     * Every photo belongs to a user
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->hasOne(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function patient(){
        return $this->hasOne(Patient::class);
    }
}
