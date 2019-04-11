<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Author;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    function testAccessor()
    {
        $sut = new Author();

        $sut->kana = 'カナ';
        $this->assertSame('ｶﾅ', $sut->kana);

        $sut->kana = 'ｶﾅ';
        $this->assertSame('ｶﾅ', $sut->kana);
    }

    /**
     * 論理削除のテスト
     *
     * Eloquentの機能を試す目的
     * @see \Illuminate\Database\Eloquent\SoftDeletes
     */
    function testSoftDelete()
    {
        Author::create(['name' => '著者A', 'kana' => 'チョシャA',]);
        /* @var $author Author */
        $author = Author::create(['name' => '著者B', 'kana' => 'チョシャB',]);
        Author::create(['name' => '著者C', 'kana' => 'チョシャC',]);
        $this->assertSame(3, Author::all()->count());

        // 論理削除
        $this->assertTrue($author->delete());
        $this->assertSame(['著者A', '著者C'], Author::all()->sortBy('name')->pluck('name')->toArray());

        // 削除済みも含めて取得
        $this->assertSame(['著者A', '著者B', '著者C'], Author::withTrashed()->get()->sortBy('name')->pluck('name')->toArray());

        // 削除済みのみ取得
        $this->assertSame(['著者B'], Author::onlyTrashed()->get()->sortBy('name')->pluck('name')->toArray());
        $this->getConnection()->commit();
    }
}
