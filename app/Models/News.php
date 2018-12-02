<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Viewable;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use Viewable;

    use SoftDeletes;

    use Translatable;

    public $translatedAttributes = ['title', 'slug', 'description', 'content', 'tags'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var boolean
     */
    public $timestamps = true;
}
