<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

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
}
