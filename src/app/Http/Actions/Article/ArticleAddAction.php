<?php
declare(strict_types=1);

namespace App\Http\Actions\Article;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\ValidationException;

/**
 * 記事追加
 */
final class ArticleAddAction extends \App\Http\Controllers\Controller
{
    /**
     * @param Request $request
     * @param ValidatorFactory $validatorFactory
     * @return Response
     */
    public function __invoke(
        Request $request,
        ValidatorFactory $validatorFactory
    ): Response {
        $inputs = $request->all();
        $rules = [
            'name' => ['required', 'max:10', 'unique:users', ],
            'email' => ['required', 'email', 'max:255', 'unique:users,email', ],
            'age' => 'integer',
        ];

        $validator = $validatorFactory->make($inputs, $rules);
        if ($validator->fails()) {
            // バリデーションエラーの場合の処理
            throw new ValidationException($validator);
        }

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
