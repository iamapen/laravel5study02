<?php
declare(strict_types=1);

namespace App\Services;

use App\Book;
use App\User;
use App\Purchase;

/**
 * トランザクションスクリプトでの実装例
 */
class BookService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * 書籍購入
     * @param array $books
     */
    public function order(array $books = [])
    {
        $purchases = [];
        /* @var \App\DataTransfer\Book $book */
        foreach ($books as $book) {
            // DBに直接アクセス
            if (!$result = Book::find($book->getId())) {
                throw new \App\Exceptions\BookStockException('在庫エラー');
            }
            $purchases[] = $result;
        }

        // ここでは購入データをDBに保存しているが、実際には決済APIを呼んだり様々な処理がされる
        foreach ($purchases as $purchase) {
            Purchase::create([
                'book_id' => $purchase->id,
                'user_id' => $this->user->id,
            ]);
        }

        // ポイント加算
        // 決済完了メール送信
    }
}
