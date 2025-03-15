<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows','following_id', 'followed_id');
    }

    public function followed()
    {

        return $this->belongsToMany(User::class, 'follows','followed_id','following_id');

    }


    // やること１　中身の構造理解して書き直す
    public function isFollowing($user)
    {
        return $this->following->contains($user);
    }

    public function getFollowingCountAttribute()
    {
        return $this->following()->count();
    }

    public function getFollowedCountAttribute()
    {
        return $this->followed()->count();
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


}
