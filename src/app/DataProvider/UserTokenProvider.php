<?php
declare(strict_types=1);

namespace App\Auth;

use App\DataProvider\UserTokenProviderInterface;
use App\Entity\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

final class UserTokenProvider implements UserProvider
{
    private $provider;

    public function __construct(UserTokenProviderInterface $provider) {
        $this->provider = $provider;
    }

    public function retrieveById($identifier)
    {
        return null;
    }

    public function retrieveByToken($identifier, $token)
    {
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // do nothing
        // APIでは利用しない
    }

    /**
     * @param array $credentials
     * @return Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (!isset($credentials['api_token'])) {
            return null;
        }

        $result = $this->provider->retrieveUserByToken($credentials['api_token']);
        if ($result === null) {
            return null;
        }

        return new User(
            $result->user_id,
            $result->api_token,
            $result->name,
            $result->email
        );
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // APIではパスワード認証は使用しない
        return false;
    }
}
