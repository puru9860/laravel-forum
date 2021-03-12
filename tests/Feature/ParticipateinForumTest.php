<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateinForumTest extends TestCase
{
    use DatabaseMigrations;


    /** @test */
    public function unauthenticated_user_may_not_add_reply()
    {
        $this->withoutExceptionHandling();
        $this->expectException(AuthenticationException::class);
        $this->post('/threads/slug/1/replies',[]);
    }


    /**
     * @test
     */
    public function an_authenticated_user_may_participate_in_forum()
    {
        $this->signIn();
        $thread = create(Thread::class);

        $reply = make(Reply::class);
        $this->post($thread->path().'/replies',$reply->toArray());
        $this->get($thread->path())->assertSee($reply->body);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->signIn();
        $thread = create(Thread::class);

        $reply = make(Reply::class,[
            'body' => null
        ]);
        $this->post($thread->path().'/replies',$reply->toArray())
        ->assertSessionHasErrors('body');

    }
}
