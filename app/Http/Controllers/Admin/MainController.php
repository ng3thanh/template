<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BlogsService;
use App\Services\ClientService;
use App\Services\FeedbackService;
use App\Services\ServiceService;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class MainController extends Controller
{
    /**
     * @var BlogsService
     */
    protected $blogService;

    /**
     * @var ClientService
     */
    protected $clientService;

    /**
     * @var ServiceService
     */
    protected $serviceService;

    /**
     * @var FeedbackService
     */
    protected $feedbackService;

    /**
     * MainController constructor.
     *
     * @param BlogsService $blogService
     * @param ClientService $clientService
     * @param ServiceService $serviceService
     * @param FeedbackService $feedbackService
     */

    public function __construct(
        BlogsService $blogService,
        ClientService $clientService,
        ServiceService $serviceService,
        FeedbackService $feedbackService
    ) {
        $this->blogService = $blogService;
        $this->clientService = $clientService;
        $this->serviceService = $serviceService;
        $this->feedbackService = $feedbackService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogCount = $this->blogService->countBlog();
//        $clientCount = $this->clientService->countClient();
        $clientCount = 0;
        $serviceCount = $this->serviceService->countService();
        $contactCount = $this->feedbackService->countFeedback();
        $views = $this->blogService->getBlogViewJson(20);
        return view('admin.dashboard', compact('blogCount', 'clientCount', 'serviceCount', 'contactCount', 'views'));
    }
}
