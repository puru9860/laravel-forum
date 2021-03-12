<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
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
        $this->get($this->thread->path())->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_of_a_thread()
    {
        $reply = create(Reply::class,[
            'thread_id' => $this->thread->id,
        ]);
        $this->get($this->thread->path())->assertSee($reply->body);
    }

    /** @test */
    public function a_user_can_filter_threads_according_to_channel()
    {
        $channel =create(Channel::class);
        $threadInChannel = create(Thread::class,['channel_id' => $channel->id]);
        $threadNotInChannel = create(Thread::class);

        $this->get("/threads/{$channel->slug}")
        ->assertSee($threadInChannel->title)
        ->assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_username()
    {
        $this->signIn(create(User::class,['name'=>'JohnDoe']));

        $threadByJohn = create(Thread::class,['user_id'=>auth()->id()]);
        $thrreadNotByJohn = create(Thread::class);

        $this->get('threads?byJhonDoe')
            ->assertSee($threadByJohn->title)
            ->assertDontSee($thrreadNotByJohn->title);
    }

}
