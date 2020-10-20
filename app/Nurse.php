<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Nurse extends Model
{
    //

    protected $fillable = ['user_id',
        'employee_id',
        'age',
        'qualification_id',
        'is_active',
        'status',
        'permanent'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function qualification(){
        return $this->belongsTo(Qualification::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    /**
     * @param $id
     * @return string
     */
    public function day_attendance($id){
        $attendance = DB::table("attendances")
            ->whereDate('created_at' , '=', date('Y-m-d'))->where('nurse_id', $id)
            ->get();

        if($attendance->isEmpty()){
            return "Not Marked";
        }else{
            return $attendance->first()->present;
        }

    }


    /**
     * @param $city
     * @return array
     */
    public function filter($city){
        $nurses = Nurse::all();
        $nurseAll = array();

        foreach ($nurses as $nurse){
          if($nurse->user->addresses->first()->city == $city){
              array_push($nurseAll, $nurse);
          }
        }

        return $nurseAll;

    }

}
