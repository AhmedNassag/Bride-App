<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table   = 'phones';
    protected $guarded = [];



    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
