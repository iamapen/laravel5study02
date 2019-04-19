<?php
declare(strict_types=1);

namespace App\DataProvider;

interface UserTokenProviderInterface
{
    /**
     * tokenでユーザを検索して返す
     * @param string $token
     * @return \stdClass|null
     */
    public function retrieveUserByToken(string $token);
}
