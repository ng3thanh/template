<?php

namespace App\Repositories\ProductsMenuTranslate;

use App\Models\ProductsMenuTranslation;
use App\Repositories\Base\BaseEloquentRepository;

class ProductsMenuTranslateEloquentRepository extends BaseEloquentRepository implements ProductsMenuTranslateRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return ProductsMenuTranslation::class;
    }
}
