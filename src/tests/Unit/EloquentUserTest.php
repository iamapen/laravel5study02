<?php
declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EloquentUserTest extends TestCase
{
    use RefreshDatabase;

    function testFind() {
        $userId = 1;
        factory(\App\User::class)->create([
            'id' => $userId,
        ]);

        $sut = new \App\User();
        $user = $sut->find($userId);
        $this->assertInstanceOf(\App\User::class, $user);
        $this->assertSame($userId, $user->id);

        $this->assertNull($sut->find(999));
    }
}
