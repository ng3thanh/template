<?php

namespace App\Repositories\Clients;

use App\Models\Clients;
use App\Repositories\Base\BaseEloquentRepository;

class ClientsEloquentRepository extends BaseEloquentRepository implements ClientsRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Clients::class;
    }
}
