<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 書籍
 * @package App
 */
class Book extends Model
{

    /**
     * 書籍は1つの著者レコードと紐づく
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(\App\Author::class);
    }

    /**
     * 書籍は1つの書籍詳細レコードを持つ
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detail()
    {
        return $this->hasOne(\App\Bookdetail::class);
    }
}
