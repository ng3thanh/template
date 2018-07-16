<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Centaur\AuthManager;
use Illuminate\Http\Request;
use Centaur\Mail\CentaurPasswordReset;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    protected $authManager;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(AuthManager $authManager)
    {
        $this->middleware('sentinel.guest');
        $this->authManager = $authManager;
    }

    /**
     * Show the password reset request form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRequest()
    {
        return view('Centaur::auth.reset');
    }

    /**
     * Send a password reset link
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRequest(Request $request)
    {
        // Validate the form data
        $result = $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);

        // Fetch the user in question
        $user = Sentinel::findUserByCredentials(['email' => $request->get('email')]);

        // Only send them an email if they have a valid, inactive account
        if ($user) {
            // Generate a new code
            $reminder = Reminder::create($user);

            // Send the email
            $code = $reminder->code;
            $email = $user->email;
            Mail::to($email)->queue(new CentaurPasswordReset($code));
        }

        $message = 'Instructions for changing your password will be sent to your email address if it is associated with a valid account.';

        if ($request->expectsJson()) {
            return response()->json(['message' => $message, 'code' => $code], 200);
        }

        Session::flash('success', $message);
        return redirect('/dashboard');
    }


    /**
     * Show the password reset form if the reset code is valid
     *
     * @param Request $request
     * @param $code
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function getReset(Request $request, $code)
    {
        // Is this a valid code?
        if (!$this->validatePasswordResetCode($code)) {
            // This route will not be accessed via ajax;
            // no need for a json response
            Session::flash('error', 'Invalid or expired password reset code; please request a new link.');
            return redirect()->route('dashboard');
        }

        return view('Centaur::auth.password')
            ->with('code', $code);
    }

    /**
     * Process a password reset form submission
     *
     * @param Request $request
     * @param $code
     * @return mixed
     */
    public function postReset(Request $request, $code)
    {
        // Validate the form data
        $result = $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        // Attempt the password reset
        $result = $this->authManager->resetPassword($code, $request->get('password'));

        if ($result->isFailure()) {
            return $result->dispatch();
        }

        // Return the appropriate response
        return $result->dispatch(route('auth.login.form'));
    }

    /**
     * @param  string $code
     * @return boolean
     */
    protected function validatePasswordResetCode($code)
    {
        return DB::table('reminders')
                ->where('code', $code)
                ->where('completed', false)->count() > 0;
    }
}
