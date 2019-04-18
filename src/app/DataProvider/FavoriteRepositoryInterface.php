<?php
declare(strict_types=1);

namespace App\DataProvider;

interface FavoriteRepositoryInterface
{
    /**
     * 「いいね」をトグルする
     * @param int $bookId
     * @param int $userId
     * @param string $createdAt
     * @return int 1=いいね登録 0=いいね取消
     */
    public function switch(int $bookId, int $userId, string $createdAt): int;
}
