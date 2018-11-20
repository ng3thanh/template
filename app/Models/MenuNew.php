<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuNew extends Model
{
    use SoftDeletes;

    use Translatable;

    public $translatedAttributes = ['name', 'slug', 'description'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_new';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var boolean
     */
    public $timestamps = true;
}
