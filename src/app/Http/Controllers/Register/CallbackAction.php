<?php
declare(strict_types=1);

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\AuthManager;
use Laravel\Socialite\Contracts\Factory;

/**
 * Socialiteを利用したユーザ作成とログイン
 * @package App\Http\Controllers\Register
 */
class CallbackAction extends Controller
{
    public function __invoke(
        Factory $factory,
        AuthManager $authManager
    ) {
        // socialite経由で外部サービスのユーザ情報を取得
        $user = $factory->driver('github')->user();
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
