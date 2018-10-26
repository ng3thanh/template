<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;
    protected $authManager;

    public function __construct()
    {

    }

    public function profile()
    {
        return view('admin.pages.users.profile');
    }

    public function updateProfile(Request $request)
    {
        dd($request->all());
    }
}
