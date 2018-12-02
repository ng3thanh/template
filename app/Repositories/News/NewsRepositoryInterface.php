<?php

namespace App\Repositories\News;

use App\Repositories\Base\BaseRepositoryInterface;

interface NewsRepositoryInterface extends BaseRepositoryInterface
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
    public function getBlogNextDate($id, $date);

    /**
     * @param $id
     * @param $date
     * @return mixed
     */
    public function getBlogPreviousDate($id, $date);
}