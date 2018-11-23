<?php

namespace App\Repositories\MenuProductTranslate;

use App\Models\MenuProductTranslation;
use App\Repositories\Base\BaseEloquentRepository;

class MenuProductTranslateEloquentRepository extends BaseEloquentRepository implements MenuProductTranslateRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return MenuProductTranslation::class;
    }
}
