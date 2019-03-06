<?php
declare(strict_types=1);

namespace App\Http\Actions\Article;

use App\Http\Requests\ArticleAddPost;
use Illuminate\Http\Response;
use Illuminate\Validation\Factory as ValidatorFactory;

/**
 * 記事追加
 */
final class ArticleAddAction extends \App\Http\Controllers\Controller
{
    /**
     * @param ArticleAddPost $request
     * @param ValidatorFactory $validatorFactory
     * @return Response
     */
    public function __invoke(ArticleAddPost $request): Response
    {
        // 登録処理
        //$this->domain->activate(
        //    $request->get('user_id'),
        //    $request->get('user_name')
        //);
        //
        //$this->bookReviewService->addReview(
        //    $request->get('user_id'),
        //    $request->get('book_id'),
        //    $request->get('review')
        //);

        return redirect('/home');
    }
}
