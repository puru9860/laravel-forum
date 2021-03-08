<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

// use PHPUnit\Framework\TestCase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function it_belongs_to_user()
    {
        $reply = Reply::factory()->create();
        $this->assertInstanceOf(User::class,$reply->user);
    }
}
