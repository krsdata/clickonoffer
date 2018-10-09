<?php

declare(strict_types=1);

namespace  Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class OfferType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offer_type';

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

    protected $fillable = ['offer_name'];
 
}
