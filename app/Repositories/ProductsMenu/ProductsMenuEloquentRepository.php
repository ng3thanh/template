<?php

namespace App\Repositories\ProductsMenu;

use App\Models\ProductsMenu;
use App\Repositories\Base\BaseEloquentRepository;

class ProductsMenuEloquentRepository extends BaseEloquentRepository implements ProductsMenuRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return ProductsMenu::class;
    }

    /**
     * @return mixed
     */
    public function getActiveProductsMenu()
    {
        $query = $this->model->orderBy('parent_id')->get();
        return $query;
    }
}
