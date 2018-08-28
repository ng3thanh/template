<?php

namespace App\Repositories\BlogsTranslate;

use App\Models\BlogsTranslation;
use App\Repositories\Base\BaseEloquentRepository;

class BlogsTranslateEloquentRepository extends BaseEloquentRepository implements BlogsTranslateRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return BlogsTranslation::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findTransBlogBaseBlogId($id)
    {
        $result = $this->model
            ->where('blogs_id', $id)
            ->get();

        return $result;
    }
}
