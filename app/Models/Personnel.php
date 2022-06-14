<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Promotion;
use Personnel_Assignment;

class Personnel extends Model
{
    use HasFactory;
    protected $table = 'personnels';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'date_of_birth',
        'gender',
        'profile_image'

    ];


    public function promotions()
    {
        return $this->hasMany('App\Models\Promotion', 'id', 'personnel_id');
    }

    public function personnel_assignment()
    {
        return $this->hasMany('App\Models\Personnel_Assignment', 'id', 'personnel_id');
    }
    
}