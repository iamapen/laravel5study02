<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Author;

class AuthorTest extends TestCase
{

    function testAccessor()
    {
        $sut = new Author();

        $sut->kana = 'カナ';
        $this->assertSame('ｶﾅ', $sut->kana);

        $sut->kana = 'ｶﾅ';
        $this->assertSame('ｶﾅ', $sut->kana);
    }
}
