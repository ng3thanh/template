<?php

namespace App\Repositories\Footers;

use App\Models\Settings;
use App\Repositories\Base\BaseEloquentRepository;

class FootersEloquentRepository extends BaseEloquentRepository implements FootersRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Settings::class;
    }
}
