<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = Thread::factory()->create();
    }

    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    public function a_user_can_view_threads()
    {
        $this->get('/threads')->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_a_single_thread()
    {
        $this->get('/threads/' . $this->thread->id)->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_of_a_thread()
    {
        $reply = Reply::factory()->create([
            'thread_id' => $this->thread->id,
        ]);
        $this->get('/threads/' . $this->thread->id)->assertSee($reply->body);
    }
}
