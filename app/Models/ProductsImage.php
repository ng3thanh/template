<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products_image';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var boolean
     */
    public $timestamps = false;
}
