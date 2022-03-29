<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Personnel_Assignment extends Model
{
    use HasFactory;
    protected $table = 'personnel_assignments';

    protected $fillable = [
        'personnel_id',
        'office_id',
        'plantilla_id',
        'date_assigned'
    ];

    public function personnel()
    {
        return $this->belongsTo('App\Models\Personnel', 'personnel_id');
    }


}
