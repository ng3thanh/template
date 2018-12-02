<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NewService;
use App\Services\ClientService;
use App\Services\FeedbackService;
use App\Services\ServiceService;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class MainController extends Controller
{
    /**
     * @var NewService
     */
    protected $newService;

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
     * @param NewService $newService
     * @param ClientService $clientService
     * @param ServiceService $serviceService
     * @param FeedbackService $feedbackService
     */

    public function __construct(
        NewService $newService,
        ClientService $clientService,
        ServiceService $serviceService,
        FeedbackService $feedbackService
    ) {
        $this->newService = $newService;
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
        $newCount = $this->newService->countNew();
//        $clientCount = $this->clientService->countClient();
        $clientCount = 0;
        $serviceCount = $this->serviceService->countService();
        $contactCount = $this->feedbackService->countFeedback();
        $views = $this->newService->getNewViewJson(20);
        return view('admin.dashboard', compact('newCount', 'clientCount', 'serviceCount', 'contactCount', 'views'));
    }
}
