<?php

namespace App\Services;

use App\Models\Users;
use App\Repositories\Users\UsersRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class AuthService
{
    /**
     * @var UsersRepositoryInterface
     */
    protected $userRepository;

    /**
     * UserService constructor.
     * @param UsersRepositoryInterface $userRepository
     */
    public function __construct(
        UsersRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Authenticate login
     *
     * @param $credentials
     * @param $remember
     * @return mixed
     */
    public function authenticate($credentials, $remember)
    {
        try {
            DB::beginTransaction();
            $login = auth()->attempt($credentials, $remember);
            if ($login) {
                $userId = auth()->user()->id;
                $data = ['login_status' => Users::LOGIN_STATUS, 'last_login' => date('Y-m-d H:i:s')];
                $this->userRepository->update($userId, $data);
            } else {
                return false;
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    /**
     * Authenticate logout
     *
     * @return bool
     */
    public function logout()
    {
        try {
            DB::beginTransaction();
            $this->userRepository->update(auth()->user()->id, ['login_status' => Users::LOGOUT_STATUS]);
            DB::commit();
            auth()->logout();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }
}