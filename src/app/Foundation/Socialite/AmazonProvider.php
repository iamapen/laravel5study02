<?php

namespace App\Foundation\Socialite;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

/**
 * Amazon OAuth認証ドライバ
 * @package App\Foundation\Socialite
 */
final class AmazonProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopes = [
        'profile',
    ];

    /**
     * OAuth認証を行うURLを返す
     * @param string $state
     * @return string
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://www.amazon.com/ap/oa', $state);
    }

    /**
     * アクセストークンを取得するURLを返す
     * @return string|void
     */
    protected function getTokenUrl()
    {
        return 'https://api.amazon.com/auth/o2/token';
    }

    /**
     * トークンを用いてユーザ情報を取得
     * @param string $token
     * @return array|void
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()
            ->get('https://api.amazon.com/user/profile', [
                'headers' => [
                    'x-amz-access-token' => $token,
                ],
            ]);
        return json_decode(strval($response->getBody()), true);
    }

    /**
     * ユーザ情報をオブジェクトにして返す
     * @param array $user
     * @return \Laravel\Socialite\Two\User|void
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['user_id'],
            'nickname' => $user['name'],
            'name' => $user['name'],
            'email' => $user['email'],
            'avatar' => '',
        ]);
    }

    /**
     * @param string $code
     * @return array
     */
    protected function getTokenFields($code)
    {
        return parent::getTokenFields($code) + [
                'grant_type' => 'authorization_code',
            ];
    }
}
