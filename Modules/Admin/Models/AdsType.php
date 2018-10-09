<?php
declare(strict_types=1);

namespace  Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class AdsType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ads_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
     * The primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
   

    protected $guarded = ['created_at', 'updated_at', 'id'];

    protected $fillable = ['title','slug','image'];

    
}
