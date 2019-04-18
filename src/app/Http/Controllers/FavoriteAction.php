<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

/**
 * 「いいね」コントローラ
 * @package App\Http\Controllers
 */
class FavoriteAction extends Controller
{
    private $favorite;

    public function __construct(FavoriteService $favorite)
    {
        $this->favorite = $favorite;
    }

    /**
     * 「いいね」切り替え
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Throwable
     */
    public function switchFavorite(Request $request)
    {
        $this->favorite->switchFavorite(
            (int)$request->get('book_id'),
            (int)$request->get('user_id'),
            Carbon::now()->toDateTimeString()
        );
        return \response('', Response::HTTP_OK);
    }
}
