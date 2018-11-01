<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\Auth\AuthRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    /**
     * @var AuthRepositoryInterface
     */
    protected $authRepository;

    /**
     * SessionController constructor.
     * @param AuthRepositoryInterface $authRepository
     */
    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Show the Login Form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('auth.auth.login');
    }

    /**
     * Handle a Login Request
     *
     * @param Request $request
     * @return mixed
     */
    public function postLogin(Request $request)
    {
        // Validate the Form Data
        $this->validate($request, ['email' => 'required', 'password' => 'required']);

        // Assemble Login Credentials
        $credentials = ['email' => trim($request->get('email')), 'password' => $request->get('password'),];
        $remember = (bool)$request->get('remember', false);

        // Attempt the Login
        $result = $this->authRepository->authenticate($credentials, $remember);

        return $result->dispatch($path);
    }

    /**
     * Handle a Logout Request
     *
     * @param Request $request
     * @return mixed
     */
    public function getLogout(Request $request)
    {
        // Terminate the user's current session.  Passing true as the
        // second parameter kills all of the user's active sessions.
        auth()->logout();
        return redirect()->route('auth.login.form');
    }
}
