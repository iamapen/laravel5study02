<?php

namespace App\Http\Responder;

use Illuminate\Http\Response;
use Illuminate\Contracts\View\Factory as ViewFactory;
use App\User as UserModel;

/**
 * レスポンス生成部分
 */
class UserResponder
{
    protected $response;
    protected $view;

    /**
     * @param Response $response
     * @param ViewFactory $view
     */
    public function __construct(Response $response, ViewFactory $view)
    {
        $this->response = $response;
        $this->view = $view;
    }

    /**
     * @param UserModel $user
     * @return Response
     */
    public function response(UserModel $user): Response
    {
        $statusCode = Response::HTTP_OK;
        if (!$user->id) {
            $statusCode = Response::HTTP_NOT_FOUND;
        }
        return response(view('user.index', ['user' => $user]), $statusCode);
    }
}
