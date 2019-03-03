<?php
declare(strict_types=1);

namespace App\Http\Actions;

use App\Services\BookReviewService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * UserController::store をアクションに切り出し
 */
final class UserStoreAction extends \App\Http\Controllers\Controller
{
    private $domain;
    private $bookReviewService;

    /**
     * @param UserService $userService
     * @param BookReviewService $bookReviewService
     */
    public function __construct(
        UserService $userService,
        BookReviewService $bookReviewService
    ) {
        $this->domain = $userService;
        $this->bookReviewService = $bookReviewService;
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $this->domain->activate(
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
