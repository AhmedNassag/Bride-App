<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table   = 'locations';
    protected $guarded = [];



    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }


    public function area()
    {
        return $this->belongsTo(Area::class,'area_id');
    }

}
