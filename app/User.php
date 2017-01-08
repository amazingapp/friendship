<?php

namespace App;

use Hootlex\Friendships\Traits\Friendable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Friendable, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id','mobile','name','designation','branch','bio','email','password','remember_token','created_at','updated_at','image',
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at','updated_at','bio', 'mobile','branch','designation',
    ];

    public static function findByEmployeeId($empId)
    {
        return self::employeeId($empId)->first();
    }

    public static function findOrFailByEmployeeId($employeeID)
    {
        return self::employeeId($employeeID)->firstOrFail();
    }

    public function scopeEmployeeId($query, $employeeID)
    {
        return $query->where('employee_id',$employeeID);
    }

    /**
       * Get all of the user's likes.
       */
    public function likes()
    {
      return $this->hasMany(Like::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getRouteKeyName()
    {
        return 'employee_id';
    }
}
