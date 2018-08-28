<?php

namespace App\Repositories\Logo;

use App\Models\Logo;
use App\Repositories\Base\BaseEloquentRepository;

class LogoEloquentRepository extends BaseEloquentRepository implements LogoRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Logo::class;
    }
}
