<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Transformable
{
    use TransformableTrait, HasApiTokens, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'avatar', 'email', 'password',
    ];

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
        'email_verified_at' =>  'datetime',
        'created_at'        =>  'datetime'
    ];

    /**
     *
     * Setters attributers
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Relations
     */
    public function offices()
    {
        return $this->belongsToMany(Office::class);
    }

    public function propoals()
    {
        return $this->hasMany(Propoal::class, 'owner_user_id');
    }

    public function goals()
    {
        return $this->hasMany(UserGoal::class);
    }


    protected static function boot() {
        parent::boot();

        static::deleting(function($user) {
            $user->goals()->delete();

        });
    }

}
