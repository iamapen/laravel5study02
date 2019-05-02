<?php
declare(strict_types=1);

namespace App\Gate;

use App\User;

/**
 * 自身のアクセスであること
 * @package App\Gate
 */
final class UserAccess
{
    public function __invoke(User $user, string $id): bool
    {
        return intval($user->getAuthIdentifier()) === intval($id);
    }
}
