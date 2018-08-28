<?php

namespace App\Repositories\Services;

use App\Repositories\Base\BaseRepositoryInterface;

interface ServicesRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Find by slug
     * @param $id
     * @return mixed
     */
    public function findBySlugRelatedId($id);
}