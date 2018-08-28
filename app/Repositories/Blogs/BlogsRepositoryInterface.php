<?php

namespace App\Repositories\Blogs;

use App\Repositories\Base\BaseRepositoryInterface;

interface BlogsRepositoryInterface extends BaseRepositoryInterface
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