<?php
declare(strict_types=1);

namespace App\Services;

use App\Purchase;
use App\Repositories\UserRepositoryInterface;
use App\User;

class UserPurchaseService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $identifier
     * @return User
     */
    public function retrievePurchase(int $identifier): User
    {
        $arrUser = $this->userRepository->find($identifier);
        // DBから取得した値を使った処理など
        $user = new User($arrUser);
        return $user;
    }
}
