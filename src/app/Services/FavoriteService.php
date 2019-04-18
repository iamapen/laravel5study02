<?php
declare(strict_types=1);

namespace App\Services;

use App\DataProvider\Eloquent\Favorite;
use App\DataProvider\FavoriteRepositoryInterface;

/**
 * 「いいね」のビジネスロジック
 * @package App\Services
 */
class FavoriteService
{
    private $favorite;

    public function __construct(FavoriteRepositoryInterface $favorite)
    {
        $this->favorite =$favorite;
    }

    /**
     * トグルする
     * @param int $bookId
     * @param int $userId
     * @param string $createdAt
     * @return int 1=いいね登録 0=いいね取消
     * @throws \Throwable DB系
     */
    public function switchFavorite(int $bookId, int $userId, string $createdAt): int
    {
        return $this->favorite->switch($bookId, $userId, $createdAt);
    }
}
