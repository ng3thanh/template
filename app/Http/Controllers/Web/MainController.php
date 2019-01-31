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
//        $slide = $this->settingsService->getSlideShowing();
//        $client = $this->clientService->getClientLimit(config('constant.number.client.paginate.web'))->first();
//        $services = $this->serviceService->getServiceLimit(config('constant.number.service.paginate.web'));
//        $blogs = $this->blogService->getBlogLimit(config('constant.number.blog.paginate.main'));
//        $introduce = $this->settingsService->getIntroduce();
//        return view('web.home', compact('slide', 'client','services', 'blogs', 'introduce'));
        $data = [
            'an_vat' => [
                0 => [
                    0 => 'Ốc'
                ],
                1 => [
                    0 => 'Bún bò Huế',
                    1 => 'Bún bề bề',
                    2 => 'Bún hải sản',
                    3 => 'Bún cá',
                    4 => 'Bún ốc',
                    5 => 'Bún riêu',
                    6 => 'Bún móng giò',
                    7 => 'Bún mọc',
                    8 => 'Bún trộn',
                    9 => 'Bún ngan',
                    10 => 'Bún đậu',
                ],
                2 => [
                    0 => 'Phở bò',
                    1 => 'Phở gà',
                    2 => 'Phở xào',
                ],
                3 => [
                    0 => 'Cháo trai',
                    1 => 'Cháo thịt',
                    2 => 'Cháo lòng',
                    3 => 'Cháo lưỡi <3',
                ],
                4 => [
                    0 => 'Miến lươn',
                    1 => 'Miến trộn',
                    2 => 'Miến ngan',
                ],
                5 => [
                    0 => 'Cơm rang',
                    1 => 'Cơm niêu',
                    2 => 'Cơm thố',
                ],
                6 => [
                    0 => 'Xôi gà',
                    1 => 'Xôi chim',
                    2 => 'Xôi thịt'
                ],
                7 => [
                    0 => 'Bò cuốn',
                    1 => 'Bánh cuốn',
                    2 => 'Bánh tráng cuốn',
                    3 => 'Phở cuốn'
                ]
            ],
            'nha_hang' => [
                0 => [
                    0 => 'Chả cá',
                    1 => 'Lẩu cá',
                    2 => 'Lẩu trâu',
                    3 => 'Lẩu bò',
                    4 => 'Lẩu gà',
                    5 => 'Lẩu vịt',
                ],
                1 => [
                    0 => 'Lẩu nướng',
                    1 => 'Gà nướng',
                ],
                2 => [
                    0 => 'Dimsum',
                    1 => 'Kimbap',
                    2 => 'Gà KFC',
                    3 => 'Đồ hàn'
                ],
            ]
        ];
        $eating = json_encode($data);
        return view('web.home', compact('eating'));
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
