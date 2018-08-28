<?php

namespace App\Repositories\BlogsTranslate;

use App\Repositories\Base\BaseRepositoryInterface;

interface BlogsTranslateRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function findTransBlogBaseBlogId($id);
}