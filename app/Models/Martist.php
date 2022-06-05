<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Martist extends Model
{
    public $guarded = [''];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function services()
    {
        return $this->hasMany(Sevice_Martist::class);
    }
}
