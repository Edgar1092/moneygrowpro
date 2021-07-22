<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class accionesMGP2021 extends Model
{
    use TransformableTrait, SoftDeletes;
    public $timestamps = false;
    protected $table= "accionsmgp2021";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'referenciaPago',
        'plataforma',
        'idUsuarioFk',
        'idFaseFk',
        'contadorReferido',
        'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

        'updated_at'        =>  'datetime',
    ];

    protected $appends = [
        'Referidos'
    ];

    // public function quotations()
    // {
    //     return $this->belongsToMany(Calculadora::class);
    // }
    
    public function referidos()
    {
        return $this->hasMany(referidomgp2021::class, 'idAccionPerteneceFk');
    }


    public function getReferidosAttribute()
    {
        $usuario = $this->referidos()->leftjoin('users','users.id','=','referidomgp2021.idUsarioFk')->get();

        if(!empty($usuario))
        {
            return $usuario;
        }else{
            return '';
        }

    }
}
