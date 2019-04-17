<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 書籍詳細
 * @package App
 */
class Bookdetail extends Model
{
    public function book() {
        return $this->belongsTo(\App\Book::class);
    }
}
