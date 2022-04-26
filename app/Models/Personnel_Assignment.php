<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Personnel_Assignment extends Model
{
    use HasFactory;
    protected $table = 'personnel_assignments';
    use SoftDeletes;
    protected $fillable = [
        'personnel_id',
        'office_id',
        'plantilla_id',
        'date_assigned'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function office()
    {
        return $this->belongsTo('App\Models\Office', 'office_id');
    }

}
