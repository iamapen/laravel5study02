<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * QueryBuilderの基本的な使い方を試す目的のテスト
 * @package Tests\Unit
 */
class QueryBuilderTest extends TestCase
{
    function testGetQueryBuilder()
    {
        // DBファサードから
        $this->assertInstanceOf(
            \Illuminate\Database\Query\Builder::class,
            DB::table('books')
        );

        // サービスコンテナのDatabaseManagerから
        $this->assertInstanceOf(
            \Illuminate\Database\Query\Builder::class,
            \Illuminate\Foundation\Application::getInstance()->make('db')->connection()->table('books')
        );
    }

    /**
     * @see \Illuminate\Database\Query\Builder::select()
     * @see \Illuminate\Database\Query\Builder::insert()
     * @see \Illuminate\Database\Query\Builder::update()
     * @see \Illuminate\Database\Query\Builder::delete()
     * @see \Illuminate\Database\Query\Builder::truncate()
     */
    function testSelect()
    {
        $ex = 'select `bookdetails`.`isbn`, `books`.`name`, `authors`.`name`, `bookdetails`.`price`';
        $ex .= ' from `books`';
        $ex .= ' left join `bookdetails` on `book`.`bookdetail_id` = `bookdetails`.`id`';
        $ex .= ' left join `authors` on `books`.`author_id` = `authors`.`id`';
        $ex .= ' where `bookdetails`.`price` >= ?';
        $ex .= ' and `bookdetails`.`published_date` >= ?';
        $ex .= ' order by `bookdetails`.`published_date` desc';
        $sql = DB::table('books')
            ->select(['bookdetails.isbn', 'books.name', 'authors.name', 'bookdetails.price'])
            ->leftJoin('bookdetails', 'book.bookdetail_id', '=', 'bookdetails.id')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->where('bookdetails.price', '>=', 1000)
            ->where('bookdetails.published_date', '>=', '2011-01-01')
            ->orderBy('bookdetails.published_date', 'desc')
            ->toSql();
        $this->assertSame($ex, $sql);
    }

    /**
     * 集計関数
     * @see \Illuminate\Database\Query\Builder::count()
     * @see \Illuminate\Database\Query\Builder::max()
     * @see \Illuminate\Database\Query\Builder::min()
     * @see \Illuminate\Database\Query\Builder::avg()
     */
    function _testCount()
    {
    }

    /**
     * @see DB::beginTransaction()
     * @see DB::rollBack()
     * @see DB::commit()
     * @see DB::transaction()
     * @see DB::transactionLevel()
     */
    function _testTransaction()
    {
    }

    /**
     * @see \Illuminate\Database\Query\Builder::sharedLock()
     * @see \Illuminate\Database\Query\Builder::lockForUpdate()
     */
    function _testLock() {
    }

    /**
     * 生のSQLはこれらで
     * @see DB::select()
     * @see DB::insert()
     * @see DB::update()
     * @see DB::delete()
     * @see DB::statement()
     */
    function _testBasic()
    {
    }
}
