<?php

namespace App\Services;

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
            $userId = auth()->user()->id;
            $data = ['login_status' => 1, 'last_login' => date('Y-m-d H:i:s')];
            if ($login) {
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
}