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
        'office',
        'office_id',
        'assist_labor_allowed',
        'instructions',
        'application_status',
        'date_submitted',
        'immediate_boss_approval',
        'div_chief_approval',
        'divchief_approval_date',
        'ared_ms_approval',
        'aredms_approval_date',
        'ared_ts_approval',
        'aredts_approval_date',
        'red_approval',
        'red_approval_date',
        'disapprove_reason',
        'disapprove_date'
    ];

    public static function IDGenerator($model,$trow,$length = 4, $prefix){
        $data = $model::orderBy('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = '';
        }else{
            $code = substr($data->$trow, strlen($prefix)+1);
            $actial_last_number = ($code/1)*1;
            $increment_last_number = ((int)$actial_last_number)+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }
        return $prefix.'-'.$zeros.$last_number;
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
