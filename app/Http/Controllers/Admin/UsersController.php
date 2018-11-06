<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UsersService;
use Illuminate\Support\Facades\Mail;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Centaur\Mail\CentaurWelcomeEmail;

class UsersController extends Controller
{
    /**
     * @var UsersService
     */
    protected $userService;

    /**
     * UsersController constructor.
     * @param UsersService $userService
     */
    public function __construct(UsersService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->createModel()->with('roles')->paginate(15);

        return view('Centaur::users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = app()->make('sentinel.roles')->createModel()->all();

        return view('Centaur::users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form data
        $result = $this->validate($request, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // Assemble registration credentials and attributes
        $credentials = [
            'email' => trim($request->get('email')),
            'password' => $request->get('password'),
            'first_name' => $request->get('first_name', null),
            'last_name' => $request->get('last_name', null)
        ];
        $activate = (bool)$request->get('activate', false);

        // Attempt the registration
        $result = $this->authManager->register($credentials, $activate);

        if ($result->isFailure()) {
            return $result->dispatch;
        }

        // Do we need to send an activation email?
        if (!$activate) {
            $code = $result->activation->getCode();
            $email = $result->user->email;
            Mail::to($email)->queue(new CentaurWelcomeEmail($email, $code));
        }

        // Assign User Roles
        foreach ($request->get('roles', []) as $slug => $id) {
            $role = Sentinel::findRoleBySlug($slug);
            if ($role) {
                $role->users()->attach($result->user);
            }
        }

        $result->setMessage("User {$request->get('email')} has been created.");
        return $result->dispatch(route('users.index'));
    }

    /**
     * Display the specified user.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        // The user detail page has not been included for the sake of brevity.
        // Change this to point to the appropriate view for your project.
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        // Fetch the user object
        // $id = $this->decode($hash);
        $user = $this->userRepository->findById($id);

        // Fetch the available roles
        $roles = app()->make('sentinel.roles')->createModel()->all();

        if ($user) {
            return view('Centaur::users.edit', [
                'user' => $user,
                'roles' => $roles
            ]);
        }

        session()->flash('error', 'Invalid user.');
        return redirect()->back();
    }

    /**
     * Update the specified user in storage.
     *
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate the form data
        $result = $this->validate($request, [
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|confirmed|min:6',
        ]);

        // Assemble the updated attributes
        $attributes = [
            'email' => trim($request->get('email')),
            'first_name' => $request->get('first_name', null),
            'last_name' => $request->get('last_name', null)
        ];

        // Do we need to update the password as well?
        if ($request->has('password')) {
            $attributes['password'] = $request->get('password');
        }

        // Fetch the user object
        $user = $this->userRepository->findById($id);
        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json("Invalid user.", 422);
            }
            session()->flash('error', 'Invalid user.');
            return redirect()->back()->withInput();
        }

        // Update the user
        $user = $this->userRepository->update($user, $attributes);

        // Update role assignments
        $roleIds = array_values($request->get('roles', []));
        $user->roles()->sync($roleIds);

        // All done
        if ($request->expectsJson()) {
            return response()->json(['user' => $user], 200);
        }

        session()->flash('success', "{$user->email} has been updated.");
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        // Fetch the user object
        $user = $this->userRepository->findById($id);

        // Check to be sure user cannot delete himself
        if (Sentinel::getUser()->id == $user->id) {
            $message = "You cannot remove yourself!";

            if ($request->expectsJson()) {
                return response()->json($message, 422);
            }
            session()->flash('error', $message);
            return redirect()->route('users.index');
        }


        // Remove the user
        $user->delete();

        // All done
        $message = "{$user->email} has been removed.";
        if ($request->expectsJson()) {
            return response()->json([$message], 200);
        }

        session()->flash('success', $message);
        return redirect()->route('users.index');
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
