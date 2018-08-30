<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\FeedbackService;
use Illuminate\Http\Request;

class FeedbacksController extends Controller
{
    /**
     * @var FeedbackService
     */
    protected $feedbackService;

    /**
     * FeedbacksController constructor.
     * @param FeedbackService $feedbackService
     */
    public function __construct(
        FeedbackService $feedbackService
    ) {
        $this->feedbackService = $feedbackService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $this->feedbackService->createFeebackFromCustomer($data);
        return redirect()->back();
    }

}
