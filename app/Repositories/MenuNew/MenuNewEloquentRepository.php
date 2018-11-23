<?php

namespace App\Repositories\MenuNew;

use App\Models\MenuNew;
use App\Repositories\Base\BaseEloquentRepository;

class MenuNewEloquentRepository extends BaseEloquentRepository implements MenuNewRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return MenuNew::class;
    }
}
