<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TravelOrder extends Model
{
    protected $table = 'travel_orders';
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'user_id',
        'to_number',
        'date_depart',
        'date_arrived',
        'destination',
        'purpose',
        'expenses',
        'assist_labor_allowed',
        'instructions',
        'application_status',
        'date_submitted',
        'immediate_boss_approval',
        'ared_ms_approval',
        'ared_ts_approval',
        'red_approval',
        'decline_reason'
    ];

}
