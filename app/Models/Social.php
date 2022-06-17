<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $table   = 'socials';
    protected $guarded = [];



    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
