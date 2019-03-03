<?php
declare(strict_types=1);

namespace App\Repositories;

use App\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param int $id
     * @return array
     */
    public function find(int $id): array
    {
        $user = User::find($id)->toArray();
        // 何かの処理
        return $user;
    }

}
