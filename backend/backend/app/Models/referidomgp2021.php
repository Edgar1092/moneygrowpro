<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class referidomgp2021 extends Model
{
    public $timestamps = false;
    protected $table= "referidomgp2021";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'id',
        'idAccionFk',
        'idUsarioFk',
        'idUsuarioPerteneceFk',
        'idAccionPerteneceFk',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'update_at', 'create_at','delete_at'
    ];
}
