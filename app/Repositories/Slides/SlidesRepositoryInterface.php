<?php

namespace App\Repositories\Slides;

use App\Repositories\Base\BaseRepositoryInterface;

interface SlidesRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get slide not show
     *
     * @param $limit
     * @return mixed
     */
    public function getSlideNotShow($limit);
}