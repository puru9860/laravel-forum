<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;
    public function setUp(): void
    {
        parent::setUp();

        $this->thread =create(Thread::class);
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
        $reply = create(Reply::class,[
            'thread_id' => $this->thread->id,
        ]);
        $this->get('/threads/' . $this->thread->id)->assertSee($reply->body);
    }
}
