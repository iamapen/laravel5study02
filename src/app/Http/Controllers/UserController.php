<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function detail(string $id): View
    {
        return view('user.detail');
    }

    public function userDetail(string $id): Response
    {
        return new Response(view('user.detail'), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // 登録処理など
    }
}