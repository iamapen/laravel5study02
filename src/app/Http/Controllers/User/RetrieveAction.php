<?php
declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

/**
 * ユーザ情報を返却する。要JWTトークン。
 * @package App\Http\Controllers\User
 */
final class RetrieveAction extends Controller
{
    private $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function __invoke(Request $request)
    {
        return $this->authManager->guard('api')->user();
    }
}
