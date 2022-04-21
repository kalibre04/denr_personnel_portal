<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plantilla;
use Personnel;

class Promotion extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'promotions';
    protected $fillable = [
        'personnel_id',
        'plantilla_id',
        'salaryStep', 
        'fromDate',
        'toDate'
    ];

    public function personnel()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function plantilla()
    {
        return $this->belongsTo('App\Models\Plantilla', 'plantilla_id');
    }

}