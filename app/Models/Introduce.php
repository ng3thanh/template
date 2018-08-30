<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Introduce extends Model
{
    use SoftDeletes;

    use Translatable;

    public $translatedAttributes = ['name', 'content'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'introduces';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var boolean
     */
    public $timestamps = true;
}
