<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    const STATUS_UNCONFIRMED = 0;
    const STAR_START = 5;
    const VOTE_COUNT_START = 0;

    use SoftDeletes;

    use Translatable;

    public $translatedAttributes = ['name', 'slug', 'description', 'content'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';

    /**
     * Default value
     *
     * @var array
     */
    protected $attributes = [
        'status' => self::STATUS_UNCONFIRMED,
        'star' => self::STAR_START,
        'vote' => self::VOTE_COUNT_START,
    ];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var boolean
     */
    public $timestamps = true;
}
