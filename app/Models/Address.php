<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $guarded = [''];

    public function martist()
    {
        return $this->belongsTo(Martist::class);
    }
}
