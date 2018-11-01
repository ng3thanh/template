<?php

namespace App\Repositories\Users;

use App\Models\Users;
use App\Repositories\Base\BaseEloquentRepository;

class UsersEloquentRepository extends BaseEloquentRepository implements UsersRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Users::class;
    }
}
