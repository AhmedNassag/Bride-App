<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $guarded = [''];

    public function martist()
    {
        return $this->belongsTo(Martist::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
