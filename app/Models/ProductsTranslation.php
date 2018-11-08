<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products_translate';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var boolean
     */
    public $timestamps = false;
}
