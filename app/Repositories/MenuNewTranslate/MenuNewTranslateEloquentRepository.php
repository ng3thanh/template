<?php

namespace App\Repositories\MenuNewTranslate;

use App\Models\MenuNewTranslation;
use App\Repositories\Base\BaseEloquentRepository;

class MenuNewTranslateEloquentRepository extends BaseEloquentRepository implements MenuNewTranslateRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return MenuNewTranslation::class;
    }
}
