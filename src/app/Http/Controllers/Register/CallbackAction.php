<?php
declare(strict_types=1);

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Illuminate\Auth\AuthManager;
use Laravel\Socialite\Contracts\Factory;
use Psr\Log\LoggerInterface;

/**
 * Socialiteを利用したユーザ作成とログイン
 * @package App\Http\Controllers\Register
 */
class CallbackAction extends Controller
{
    public function __invoke(
        Factory $factory,
        AuthManager $authManager,
        LoggerInterface $logger
    ) {
        /* @var $driver \Laravel\Socialite\Two\GithubProvider */
        $driver = $factory->driver('github');
        // 通信内容をログとして出力させる例
        $driver->setHttpClient(
            new Client([
                'handler' => tap(
                    HandlerStack::create(),
                    function (HandlerStack $stack) use ($logger) {
                        $stack->push(Middleware::log($logger, new MessageFormatter()));
                    }
                )
            ])
        );

        // socialite経由で外部サービスのユーザ情報を取得
        $user = $driver->user();
        // ユーザ作成＆ログイン
        $authManager->guard()->login(
            User::firstOrCreate([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => '',
            ]),
            true    // 自動ログイン有効
        );
        // Facadeを使って Auth::login() としてもいい

        return redirect('/home');
    }
}
