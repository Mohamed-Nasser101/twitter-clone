<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Followable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar',
        'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function timeline(){
        $ids = $this->follows()->pluck('following_user_id');
        $ids->push($this->id);

        return Tweet::whereIn('user_id',$ids)->WithLikes()->latest()->with('user')->paginate(10);
    }

    public function tweets(){
        return $this->hasMany(Tweet::class)->latest();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getAvatarAttribute(){
        return "https://i.pravatar.cc/200?u=" . $this->email;
        //return asset($value);
    }

    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }
}
