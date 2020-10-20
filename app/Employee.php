<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','employee_id','role', 'city',
        'is_active',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function role($id){
        return Role::where('id', $id)->get()->first()->role;
    }


    /**
     * @param $data
     * @return mixed
     */
    public function filter($data){
        if($data['city'] == null && $data['role'] == null){
            $employees = Employee::latest()->paginate();
        }
        elseif($data['role'] == null){
            $employees = Employee::where('city', $data['city'])
                ->get();
        }elseif ($data['city'] == null){
            $employees = Employee::where('role', $data['role'])
                ->get();
        }else{
            $employees = Employee::where('role', $data['role'])
                ->where('city', $data['city'])
                ->get();
        }

        return $employees;
    }
}
