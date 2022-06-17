<?php

namespace App;

use App\Models\Gallery;
use App\Models\Location;
use App\Models\Package;
use App\Models\Phone;
use App\Models\Social;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table   = 'users';
    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function phones()
    {
       return $this->hasMany(Phone::class,'user_id');
    }


    public function socials()
    {
        return $this->hasMany(Social::class,'user_id');
    }


    public function locations()
    {
        return $this->hasMany(Location::class,'user_id');
    }


    public function packages()
    {
        return $this->hasMany(Package::class,'user_id');
    }


    public function galleries()
    {
        return $this->hasMany(Gallery::class,'user_id');
    }

}
