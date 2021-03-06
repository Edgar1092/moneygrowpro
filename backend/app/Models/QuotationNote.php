<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class QuotationNote.
 *
 * @package namespace App\Models;
 */
class QuotationNote extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'quotation_id',
        'user_id'
    ];

    /**
     * Relations
     */

    public function quotation()
    {
        return $this->belongsTo(Quotation::Class);
    }

    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function files()
    {
        return $this->belongsToMany(File::class,'relation_file','rel_id','file_id')
        ->where('table_name',$this->getTable());
    }
}
