<?php

namespace App\Repositories\ServicesTranslate;

use App\Models\ClientsTranslation;
use App\Models\ServicesTranslation;
use App\Repositories\Base\BaseEloquentRepository;

class ServicesTranslateEloquentRepository extends BaseEloquentRepository implements ServicesTranslateRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return ServicesTranslation::class;
    }
}
