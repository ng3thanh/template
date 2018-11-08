<?php

namespace App\Repositories\ProductsTranslate;

use App\Repositories\Base\BaseRepositoryInterface;

interface ProductsTranslateRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Find by id related slug
     * @param $id
     * @return mixed
     */
    public function findByIdRelatedSlug($id);

    /**
     * @param $id
     * @param $date
     * @return mixed
     */
    public function getProductNextDate($id, $date);

    /**
     * @param $id
     * @param $date
     * @return mixed
     */
    public function getProductPreviousDate($id, $date);
}