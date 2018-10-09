<?php

declare(strict_types=1);

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

use Nestable\NestableTrait;

class Category extends Eloquent
{

    protected $parent = 'parent_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $casts = [
        'created_at' => 'datetime:m-d-Y',
    ];

    protected $table = 'ads_categories';
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

    /**++
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','slug','image','description'];  // All field of user table here


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
}
