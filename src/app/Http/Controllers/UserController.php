<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class UserController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        $user = User::find($request->get('id'));
        if ($user === null) {
            throw new NotFoundHttpException();
        }

        return view('user.index', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        // 登録処理など
    }
}