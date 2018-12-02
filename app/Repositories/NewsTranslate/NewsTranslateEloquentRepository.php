<?php

namespace App\Repositories\NewsTranslate;

use App\Models\NewsTranslation;
use App\Repositories\Base\BaseEloquentRepository;

class NewsTranslateEloquentRepository extends BaseEloquentRepository implements NewsTranslateRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return NewsTranslation::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findTransBlogBaseBlogId($id)
    {
        $result = $this->model
            ->where('news_id', $id)
            ->get();

        return $result;
    }
}
