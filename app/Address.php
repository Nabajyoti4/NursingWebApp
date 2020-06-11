<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable = ['user_id',
        'city',
        'state',
        'country',
        'street',
        'police_station',
        'post_office',
        'pin_code',
        'landmark'];


    /**
     * every address belongs to a user
     * there is a current and permanent address
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }




}
