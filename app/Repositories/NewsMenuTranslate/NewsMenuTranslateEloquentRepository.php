<?php

namespace App\Repositories\NewsMenuTranslate;

use App\Models\NewsMenuTranslation;
use App\Repositories\Base\BaseEloquentRepository;

class NewsMenuTranslateEloquentRepository extends BaseEloquentRepository implements NewsMenuTranslateRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return NewsMenuTranslation::class;
    }
}
