<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sevice_Martist extends Model
{
    public $guarded = [''];

    public function martist()
    {
        return $this->belongsTo(Martist::class);
    }

    public function service()
    {
        return $this->belongsTo(Sevice::class);
    }
}
