<?php

namespace App\Repositories\NewsTranslate;

use App\Repositories\Base\BaseRepositoryInterface;

interface NewsTranslateRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function findTransBlogBaseBlogId($id);
}