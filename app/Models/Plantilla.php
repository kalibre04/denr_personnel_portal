<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Office;
use Promotion;

class Plantilla extends Model
{
    use HasFactory;
    protected $table = 'plantillas';

    protected $fillable = [
        'personnel_id',
        'plantilla_id',
        'salaryStep',
        'fromDate',
        'toDate'
    ];


    public function office()
    {
        return $this->belongsTo('App\Models\Office', 'office_id', );
    }

    public function promotions()
    {
        return $this->hasMany('App\Models\Promotion', 'id', 'plantilla_id');
    }
}
