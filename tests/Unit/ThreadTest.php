<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    protected $thread;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = create(Thread::class);
    }

    /** @test */
    public function a_thread_has_replies()
    {
        $this->assertInstanceOf(Collection::class,$this->thread->replies);
    }

    /** @test */
    public function a_thread_has_owner()
    {
        $this->assertInstanceOf(User::class,$this->thread->user);
    }

    /** @test */
    public function a_thread_can_add_reply()
    {
        $this->thread->addReply([
            'body' => 'Foo',
            'user_id' => 3
        ]);

        $this->assertCount(1,$this->thread->replies);
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum()
    {
        $this->signIn();
        $thread = create(Thread::class);

        $reply = make(Reply::class);
        $this->post('/threads/'.$thread->id.'/replies',$reply->toArray());

        $this->get('/threads/'.$thread->id)->assertSee($reply->body);
    }

}
