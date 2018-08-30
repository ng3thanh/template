<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedbacks;
use App\Services\FeedbackService;
use Illuminate\Http\Request;

class ContactsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = config('constant.number.feedback.paginate.admin');
        $contacts = $this->feedbackService->getPaginateFeedback($limit);
        return view('admin.pages.contacts.index', compact('contacts', 'limit'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $listFeedback = $this->feedbackService->getFeedbackRelated($id);
        return view('admin.pages.contacts.detail', compact('listFeedback'));
    }
}
