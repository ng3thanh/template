<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Viewable;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use Viewable;

    use SoftDeletes;

    use Translatable;

    public $translatedAttributes = ['locale', 'name', 'price', 'content', 'description'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var boolean
     */
    public $timestamps = true;
}
