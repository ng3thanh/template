<?php

namespace App\Repositories\Feedbacks;

use App\Repositories\Base\BaseRepositoryInterface;

interface FeedbacksRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $mail
     * @return mixed
     */
    public function getFeedbackRelatedMail($mail);
}