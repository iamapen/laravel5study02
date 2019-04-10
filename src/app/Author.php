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

    // created_at/updated_atを記録する(デフォルト)
    public $timestamps = true;


    /**
     * kanaカラムの値を半角カナに変換して返すアクセサ
     * @param string $value
     * @return string
     */
    public function getKanaAttribute(string $value): string
    {
        return mb_convert_kana($value, 'k');
    }

    /**
     * ミューテータ
     * @param string $value
     */
    public function setKanaAttribute(string $value)
    {
        // 全角カナに変換
        $this->attributes['kana'] = mb_convert_kana($value, 'KV');
    }
}
