<?php
declare(strict_types=1);

namespace App\DataProvider\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * 「いいね」のRDBアクセス
 * @package App\DataProvider\Eloquent
 */
class Favorite extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'created_at',
    ];
}
