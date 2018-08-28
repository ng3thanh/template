<?php

namespace App\Repositories\Slides;

use App\Models\Slides;
use App\Repositories\Base\BaseEloquentRepository;

class SlidesEloquentRepository extends BaseEloquentRepository implements SlidesRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Slides::class;
    }

    /**
     * Get slide not show
     *
     * @param $limit
     * @return mixed
     */
    public function getSlideNotShow($limit){
        $data = $this->model->onlyTrashed()->limit($limit);
        return $data;
    }
}
