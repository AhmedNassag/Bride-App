<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sevice extends Model
{
    public $guarded = [''];

    public function servicesMartists()
    {
        return $this->hasMany(Sevice_Martist::class);
    }
}
