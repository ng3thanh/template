<?php

namespace App\Repositories\MenuProduct;

use App\Repositories\Base\BaseRepositoryInterface;

interface MenuProductRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getActiveMenuProduct();
}