<?php
declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Responder\TokenResponder;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * ログインしてトークンを返却する
 * @package App\Http\Controllers\User
 */
final class LoginAction extends Controller
{
    private $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function __invoke(Request $request, TokenResponder $responder): JsonResponse
    {
        /* @var $guard \Tymon\JWTAuth\JWTGuard */
        $guard = $this->authManager->guard('api');
        $token = $guard->attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);

        return $responder(
            $token,
            $guard->factory()->getTTL() * 60        // TODO
        );
    }
}
