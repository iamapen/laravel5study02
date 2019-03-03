<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\BookReviewService;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * 依存関係が増えてきた例
 */
final class UserController extends \App\Http\Controllers\Controller
{
    private $userService;
    private $bookReviewService;

    /**
     * FIXME: 特定アクション(store)が依存するサービス(BookReviewService)がコントローラに追加されてしまっている
     * @param UserService $userService
     * @param BookReviewService $bookReviewService
     */
    public function __construct(
        UserService $userService,
        BookReviewService $bookReviewService
    ) {
        $this->userService = $userService;
        $this->bookReviewService = $bookReviewService;
    }

    public function index(Request $request): View
    {
        $user = $this->userService->retrieveUser($request->get('id'));
        if ($user === null) {
            throw new NotFoundHttpException();
        }

        return view('user.index', [
            'user' => $user,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->userService->activate(
            $request->get('user_id'),
            $request->get('user_name')
        );

        $this->bookReviewService->addReview(
            $request->get('user_id'),
            $request->get('book_id'),
            $request->get('review')
        );

        return redirect('/users');
    }
}
