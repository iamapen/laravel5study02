<?php
declare(strict_types=1);

namespace App\Http\Actions\Article;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * 記事追加
 */
final class ArticleAddAction extends \App\Http\Controllers\Controller
{
    public function __invoke(Request $request): Response
    {
        $rules = [
            'name' => ['required', 'max:10', 'unique:users',],
            'email' => ['required', 'email', 'max:255', 'unique:users,email',],
            'age' => 'integer',
        ];

        $this->validate($request, $rules);

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
