<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plantilla;


class Office extends Model
{
    use HasFactory;
    protected $table = 'offices';
    




    public function plantilla()
    {
        return $this->hasMany('App\Models\Plantilla', 'id', 'office_id');
    }


}
