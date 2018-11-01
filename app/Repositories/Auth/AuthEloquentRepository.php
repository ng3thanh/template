<?php

namespace App\Repositories\Auth;

use App\Models\Users;
use App\Repositories\Base\BaseEloquentRepository;

class AuthEloquentRepository extends BaseEloquentRepository implements AuthRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Users::class;
    }

    public function authenticate()
    {
        
    }
}
