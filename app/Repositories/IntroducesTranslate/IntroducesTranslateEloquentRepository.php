<?php

namespace App\Repositories\IntroducesTranslate;

use App\Models\ClientsTranslation;
use App\Models\IntroduceTranslation;
use App\Repositories\Base\BaseEloquentRepository;

class IntroducesTranslateEloquentRepository extends BaseEloquentRepository implements IntroducesTranslateRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return IntroduceTranslation::class;
    }
}
