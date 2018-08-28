<?php

namespace App\Repositories\Feedbacks;

use App\Models\Feedbacks;
use App\Repositories\Base\BaseEloquentRepository;
use Illuminate\Support\Facades\DB;

class FeedbacksEloquentRepository extends BaseEloquentRepository implements FeedbacksRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Feedbacks::class;
    }

    /**
     * @param $mail
     * @return mixed
     */
    public function getFeedbackRelatedMail($mail)
    {
        $result = $this->model->where('mail', $mail)->orderBy('created_at', 'desc')->get();
        return $result;
    }
}
