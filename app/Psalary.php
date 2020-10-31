<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Psalary extends Model
{
    protected $fillable =
        ['nurse_id',
            'basic',
            'per_day_rate',
            'month_days',
            'full_day',
            'half_day',
            'special_allowance',
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
            'status',
            'area'];

}
