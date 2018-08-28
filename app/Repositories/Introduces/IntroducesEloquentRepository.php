<?php

namespace App\Repositories\Introduces;

use App\Models\Introduce;
use App\Repositories\Base\BaseEloquentRepository;

class IntroducesEloquentRepository extends BaseEloquentRepository implements IntroducesRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Introduce::class;
    }
}
