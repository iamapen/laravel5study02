<?php
declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Responder\UserResponder;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * UserController::index をアクションに切り出し
 */
final class UserIndexAction extends \App\Http\Controllers\Controller
{
    private $domain;
    private $userResponder;

    /**
     * @param UserService $userService
     * @param UserResponder $userResponder
     */
    public function __construct(
        UserService $userService,
        UserResponder $userResponder
    ) {
        $this->domain = $userService;
        $this->userResponder = $userResponder;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $user = $this->domain->retrieveUser($request->get('id'));
        return $this->userResponder->response($user);
    }
}
