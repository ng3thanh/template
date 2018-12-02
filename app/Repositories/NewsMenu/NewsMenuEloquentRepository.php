<?php

namespace App\Repositories\NewsMenu;

use App\Models\NewsMenu;
use App\Repositories\Base\BaseEloquentRepository;

class NewsMenuEloquentRepository extends BaseEloquentRepository implements NewsMenuRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return NewsMenu::class;
    }
}
