<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Eloquentの基本的な使い方を試す目的のテスト
 * @package Tests\Unit
 */
class EloquentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // region=insert

        // createを利用した新規登録
        \App\Author::create([
            'name' => '著者A',
            'kana' => 'チョシャA',
        ]);
        \App\Author::create([
            'name' => '著者B',
            'kana' => 'チョシャB',
        ]);

        // saveを利用した新規登録
        $author = new \App\Author();
        $author->name = '著者C';
        $author->kana = 'チョシャC';
        $author->save();

        // endregion


        // region=select

        // 全件
        $authors = \App\Author::all();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $authors);
        $this->assertSame(3, $authors->count());
        // SELECT COUNT()
        $count = \App\Author::count();
        $this->assertSame(3, $count);

        // pkey=1
        $author = \App\Author::find(1);
        $this->assertInstanceOf(\App\Author::class, $author);
        $this->assertSame(1, $author->id);

        // idが1より大きいレコードを抽出(コレクションのフィルタ)
        $filterdAuthors = $authors->filter(function ($author) {
            return $author->id > 1;
        });
        $this->assertSame(2, $filterdAuthors->count());

        // 条件指定
        /* @var $authors \Illuminate\Database\Eloquent\Collection */
        $authors = \App\Author::whereName('山田太郎')->get();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $authors);
        $this->assertSame(0, $authors->count());

        // WHERE id=1 OR id=2
        $authors = \App\Author::where('id', 1)->orWhere('id', 2)->get();
        $this->assertSame(2, $authors->count());

        // id>=2 ORDER BY id
        $authors = \App\Author::where('id', '>=', 2)
            ->orderBy('id', 'desc')->get();
        $this->assertSame(2, $authors->count());
        $this->assertSame([3, 2], $authors->pluck('id')->toArray());


        // pkey=999
        $author = \App\Author::find(999);
        $this->assertNull($author);

        $e = null;
        try {
            // pkey=10, なければ例外
            $author = \App\Author::findOrFail(999);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        }
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\ModelNotFoundException::class, $e);

        // endregion


        // 更新
        $this->assertTrue(\App\Author::find(1)->update(['name' => '著者X']));
        $this->assertSame('著者X', \App\Author::find(1)->name);

        // deleteによる削除
        $author = \App\Author::find(1);
        $this->assertTrue($author->delete());

        // destroyによる削除
        $this->assertSame(1, \App\Author::destroy(2));
        $this->assertSame(0, \App\Author::destroy(999));
    }

    function testFirstOrCreate()
    {
        $this->assertSame(0, \App\Author::where('name', 'なければ作成(static)')->get()->count());

        // なければ作成
        \App\Author::firstOrCreate(['name' => 'なければ作成(static)', 'kana' => 'カナ']);
        $this->assertSame(1, \App\Author::where('name', 'なければ作成(static)')->get()->count());

        // あれば何もせず
        \App\Author::firstOrCreate(['name' => 'なければ作成(static)', 'kana' => 'カナ']);
        $this->assertSame(1, \App\Author::where('name', 'なければ作成(static)')->get()->count());
    }

    function testFirstOrNew()
    {
        $this->assertSame(0, \App\Author::where('name', 'なければ作成(static)')->get()->count());

        // なければ作成
        $author = \App\Author::firstOrNew(['name' => 'なければ作成(static)', 'kana' => 'カナ']);
        $author->save();
        $this->assertSame(1, \App\Author::where('name', 'なければ作成(static)')->get()->count());

        // あれば何もせず
        $author = \App\Author::firstOrNew(['name' => 'なければ作成(static)', 'kana' => 'カナ']);
        $author->save();
        $this->assertSame(1, \App\Author::where('name', 'なければ作成(static)')->get()->count());
    }

    function testToSql()
    {
        \App\Author::firstOrCreate(['name' => 'なければ作成(static)', 'kana' => 'カナ']);
        $this->assertSame(
            'select * from `authors` where `authors`.`deleted_at` is null',
            \App\Author::firstOrCreate(['name' => 'なければ作成(static)', 'kana' => 'カナ'])->toSql()
        );
    }

    function testGetQueryLog()
    {
        $sql1 = 'select * from `authors` where (`name` = ? and `kana` = ?) and `authors`.`deleted_at` is null limit 1';
        $sql2 = 'insert into `authors` (`name`, `kana`, `updated_at`, `created_at`) values (?, ?, ?, ?)';

        DB::enableQueryLog();
        \App\Author::firstOrCreate(['name' => 'なければ作成(static)', 'kana' => 'カナ']);
        $logs = DB::getQueryLog();
        $this->assertSame($sql1, $logs[0]['query']);
        $this->assertSame($sql2, $logs[1]['query']);
        DB::disableQueryLog();
    }
}
