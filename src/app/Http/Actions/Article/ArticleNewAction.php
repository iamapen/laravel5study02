<?php
declare(strict_types=1);

namespace App\Http\Actions\Article;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * 記事追加画面
 */
final class ArticleNewAction extends \App\Http\Controllers\Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return response(view('article.add'));
    }
}
