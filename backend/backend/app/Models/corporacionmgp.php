<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class corporacionmgp extends Model
{
    use TransformableTrait, SoftDeletes;
    public $timestamps = false;
    protected $table= "corporacionmgp";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'idAccionEnvioFk',
        'entrada',
        'salida',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

        'updated_at'        =>  'datetime',
    ];

  


}
