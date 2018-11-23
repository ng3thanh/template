<?php

namespace App\Repositories\MenuProduct;

use App\Models\MenuProduct;
use App\Repositories\Base\BaseEloquentRepository;

class MenuProductEloquentRepository extends BaseEloquentRepository implements MenuProductRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return MenuProduct::class;
    }

    /**
     * @return mixed
     */
    public function getActiveMenuProduct()
    {
        $query = $this->model->orderBy('level')->get();
        return $query;
    }
}
