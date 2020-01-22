<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Office.
 *
 * @package namespace App\Models;
 */
class Office extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    public $timestamps = true;
    protected $softDelete = true;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at'        =>  'datetime'
    ];

    protected $fillable  = [
        'name',
        'contact',
        'email',
        'phone_1',
        'phone_2',
        'zip_code',
        'city',
        'street',
        'colony',
        'observation',
        'responsible_id',
    ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function propoals()
    {
        return $this->hasMany(Propoal::class);
    }

    public function collaborators()
    {
        return $this->hasMany(Collaborator::class);
    }

    public function goals()
    {
        return $this->hasMany(UserGoal::class);
    }


    protected static function boot() {
        parent::boot();

        static::deleting(function($office) {
            $office->collaborators()->delete();
            $office->propoals()->delete();
            $office->tasks()->delete();
            $office->services()->delete();
            $office->goals()->delete();
        });
    }
}
