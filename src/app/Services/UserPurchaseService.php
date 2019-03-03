<?php
declare(strict_types=1);

namespace App\Services;

use App\Purchase;
use App\User;

class UserPurchaseService
{
    /**
     * @param int $identifier
     * @return User
     */
    public function retrievePurchase(int $identifier): User
    {
        $user = User::find($identifier);
        $user->purchase = Purchase::findAllBy($user->id);
        // DBから取得した値を使った処理など

        return $user;
    }
}
