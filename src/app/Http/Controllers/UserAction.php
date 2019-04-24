<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 6-2-4 コントローラでトークン認証によるユーザ情報取得例
 * @package App\Http\Controllers
 */
class UserAction extends Controller
{
    private $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function __invoke(Request $request)
    {
        // 認証したユーザ情報にアクセス
        // Authファサードを利用しても構わない
        /* @var $user \App\Entity\User */
        $user = $this->authManager->guard('api')->user();

        return new JsonResponse([
            'id' => $user->getAuthIdentifier(),
            'name' => $user->getName(),
        ]);
    }
}
