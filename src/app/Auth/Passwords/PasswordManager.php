<?php
declare(strict_types=1);

namespace App\Auth\Passwords;

use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Support\Str;

/**
 * パスワードリセットの拡張
 * @package App\Auth\Passwords
 */
class PasswordManager extends PasswordBrokerManager
{
    protected function createTokenRepository(array $config)
    {
        $key = $this->app['config']['app.key'];

        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }

        $connection = $config['connection'] ?? null;

        // 独自の TokenRepository を使う
        return new CustomTokenRepository(
            $this->app['db']->connection($connection),
            $this->app['hash'],
            $config['table'],
            $key,
            $config['expire']
        );
    }
}
