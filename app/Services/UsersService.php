<?php

namespace App\Services;

use App\Repositories\Users\UsersRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class UsersService
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
     * Update profile by user with data in service logic
     *
     * @param $data
     * @return bool
     */
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