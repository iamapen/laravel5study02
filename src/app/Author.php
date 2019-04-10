<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // Mass Assignmentによる編集可能なカラムのホワイトリスト指定
    protected $fillable = ['name', 'kana'];
}
