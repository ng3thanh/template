<?php

namespace App\Repositories\Products;

use App\Repositories\Base\BaseRepositoryInterface;

interface ProductsRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $data
     * @param null $limit
     * @param string $orderBy
     * @return mixed
     */
    public function getAllProductWithTrash($data, $limit = null, $orderBy = 'created_at');
}