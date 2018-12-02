<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\NewService;
use App\Services\ClientService;
use App\Services\ServiceService;
use App\Services\SettingService;

class MainController extends Controller
{
    /**
     * @var NewService
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
     * @var SettingService
     */
    protected $settingsService;

    /**
     * MainController constructor.
     *
     * @param NewService $blogService
     * @param ClientService $clientService
     * @param ServiceService $serviceService
     * @param SettingService $settingsService
     */
    public function __construct(
        NewService $blogService,
        ClientService $clientService,
        ServiceService $serviceService,
        SettingService $settingsService
    ) {
        $this->blogService = $blogService;
        $this->clientService = $clientService;
        $this->serviceService = $serviceService;
        $this->settingsService = $settingsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = $this->settingsService->getSlideShowing();
        $client = $this->clientService->getClientLimit(config('constant.number.client.paginate.web'))->first();
        $services = $this->serviceService->getServiceLimit(config('constant.number.service.paginate.web'));
        $blogs = $this->blogService->getBlogLimit(config('constant.number.blog.paginate.main'));
        $introduce = $this->settingsService->getIntroduce();
        return view('web.home', compact('slide', 'client','services', 'blogs', 'introduce'));
    }

    /**
     * Change website language
     * @param $language
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLanguage($language)
    {
        session()->put('website_language', $language);
        return redirect()->back();
    }
}
