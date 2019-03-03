<?php
declare(strict_types=1);

namespace App\Services;

/**
 * 書籍レビュー
 */
class BookReviewService
{

    /**
     * レビュー追加
     * @param string $userId
     * @param string $bookId
     * @param string $body
     */
    public function addReview(
        string $userId,
        string $bookId,
        string $body
    ) {
        // レビュー保存
    }
}
