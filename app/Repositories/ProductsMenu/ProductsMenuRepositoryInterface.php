<?php

namespace App\Repositories\ProductsMenu;

use App\Repositories\Base\BaseRepositoryInterface;

interface ProductsMenuRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getActiveProductsMenu();
}