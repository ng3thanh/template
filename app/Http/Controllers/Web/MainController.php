<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\BlogsService;
use App\Services\ClientService;
use App\Services\ServiceService;
use App\Services\SettingsService;

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
     * @var SettingsService
     */
    protected $settingsService;

    /**
     * MainController constructor.
     *
     * @param BlogsService $blogService
     * @param ClientService $clientService
     * @param ServiceService $serviceService
     * @param SettingsService $settingsService
     */
    public function __construct(
        BlogsService $blogService,
        ClientService $clientService,
        ServiceService $serviceService,
        SettingsService $settingsService
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
