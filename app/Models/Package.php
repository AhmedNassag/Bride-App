<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table   = 'packages';
    protected $guarded = [];



    public function galleries()
    {
        return $this->hasMany(Gallery::class,'user_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
