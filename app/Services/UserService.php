<?php

namespace App\Services;

use App\Repositories\Users\UsersRepositoryInterface;
use Cartalyst\Sentinel\Sentinel;
use Centaur\AuthManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class UserService
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

    public function updateProfileByUser($data)
    {
        $userId = auth()->user()->id;
        try {
            DB::beginTransaction();
            $this->userRepository->update($userId, $data);
            DB::commit();
            return true;
        } catch (Exception $e) {
            logger(__METHOD__ . ' - Error: '. $e->getMessage());
            DB::rollBack();
            return false;
        }
    }
}