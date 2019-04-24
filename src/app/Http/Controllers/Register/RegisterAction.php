<?php
declare(strict_types=1);

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Contracts\Factory;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * 登録画面。外部サービスへリダイレクト
 * @package App\Http\Controllers\Register
 */
final class RegisterAction extends Controller
{
    public function __invoke(Factory $factory): RedirectResponse
    {
        // 外部サービスの呼び出し
        return $factory->driver('github')->redirect();
    }
}
