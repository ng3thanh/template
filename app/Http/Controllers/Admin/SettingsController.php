<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingsService;
use App\Services\SlideService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * @var SettingsService
     */
    protected $settingService;

    /**
     * SettingsController constructor.
     * @param SettingsService $settingService
     */
    public function __construct(
        SettingsService $settingService
    ) {
        $this->settingService = $settingService;
    }
    /**
     * Display a listing of info in footer.
     *
     * @return \Illuminate\Http\Response
     */
    public function footerIndex()
    {
        $footerInfo = $this->settingService->getFooterInfo();
        $faIcon = config('constant.fa-icon');
        return view('admin.pages.settings.settings.index', compact('footerInfo', 'faIcon'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function footerUpdate(Request $request)
    {
        $data = $request->except('_token');
        $result = $this->settingService->updateFooterSetting($data);
        if ($result) {
            return redirect()->back()->with('success', 'Update footer setting successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when update footer setting.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function footerDelete($id)
    {
        $result = $this->settingService->deleteFooter($id);
        if ($result) {
            return redirect()->route('footer.index')->with('success', 'Delete data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when delete data')->withInput();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function footerStore(Request $request)
    {
        $data = $request->except('_token');
        $result = $this->settingService->addNewFooterSetting($data);
        if ($result) {
            return redirect()->back()->with('success', 'Update footer setting successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when update footer setting.');
        }
    }

    /**
     * Display a listing of the slides.
     *
     * @return \Illuminate\Http\Response
     */
    public function slideIndex()
    {
        $slideShow = $this->settingService->getSlideShowing();
        $slideNotShow = $this->settingService->getSlideNotShow(config('constant.number.slide.not_show'));

        return view('admin.pages.settings.slides.index', compact('slideShow', 'slideNotShow'));
    }

    /**
     * Store a newly slide in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function slideStore(Request $request)
    {
        $data = $request->except('_token');
        $result = $this->settingService->createSlide($data);
        if ($result) {
            return redirect()->route('slide.index')->with('success', 'Create new slide successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when save slide');
        }
    }

    /**
     * Choosing slide show
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function slideChoose($id) {
        $result = $this->settingService->chooseSlide($id);
        if ($result) {
            return redirect()->route('slide.index')->with('success', 'Change slide successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when change slide');
        }
    }

    /**
     * Get introduce
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function introduceIndex() {
        $introduce = $this->settingService->getIntroduce();
        return view('admin.pages.settings.introduces.index', compact('introduce'));
    }

    /**
     * Update introduce
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function introduceUpdate(Request $request, $id)
    {
        $data = $request->except('_token', '_method');
        $result = $this->settingService->updateIntroduce($id, $data);
        if ($result) {
            return redirect()->route('introduce.index')->with('success', 'Update data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when update data')->withInput();
        }
    }

    /**
     * Get Logo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logoIndex() {
        $logo = $this->settingService->getLogo();
        return view('admin.pages.settings.logo.index', compact('logo'));
    }

    /**
     * Update logo
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function logoUpdate(Request $request)
    {
        $data = $request->except('_token');
        $result = $this->settingService->updateLogo($data);
        if ($result) {
            return redirect()->route('logo.index')->with('success', 'Update data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when update data')->withInput();
        }
    }
}
