<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table   = 'areas';
    protected $guarded = [];


    public function locations()
    {
        return $this->hasMany(Location::class,'area_id');
    }
}
