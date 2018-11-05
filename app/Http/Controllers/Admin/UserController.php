<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    /**
     * Get profile page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        return view('admin.pages.users.profile.index');
    }

    /**
     * Update profile
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $data = $request->except('_token');
        $update = $this->userService->updateProfileByUser($data);
        if ($update) {
            return redirect()->back()->with('success', __('message.success.update'));
        } else {
            return redirect()->back()->with('success', __('message.error.update'));
        }
    }
}
