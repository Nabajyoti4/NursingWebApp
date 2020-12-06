<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tsalary extends Model
{
    protected $fillable =
        ['nurse_id',
            'basic',
            'month_days',
            'per_day_rate',
            'full_day',
            'half_day',
            'status',
            'special_allowance',
            'ta_da',
            'hra',
            'bonus',
            'advance',
            'total',
            'deduction',
            'net',
            'esic',
            'pf',
            'payment_received_date',
            'remarks',
            'area',
            'shift',
            'payment_mode'];


}
