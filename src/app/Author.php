<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // Mass Assignmentによる編集可能なカラムのブラックリスト指定
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // テーブル名を指定できる
    protected $table = 'authors';

    // primary keyを指定できる
    protected $primaryKey = 'id';
}
