<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Viewable;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activations extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activations';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var boolean
     */
    public $timestamps = true;
}
