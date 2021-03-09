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


    // /** @test */
    // public function unauthenticated_user_may_not_add_reply()
    // {
    //     $this->expectException(AuthenticationException::class);
    //     $this->post('/threads/1/replies',[]);
    // }


    /**
     * @test
     */
    public function an_authenticated_user_may_participate_in_forum()
    {
        $this->be($user = User::factory()->create());
        $thread = Thread::factory()->create();

        $reply = Reply::factory()->make([
            'thread_id' => $thread->id
        ]);
        $this->post('/threads/'.$thread->id.'/replies',$reply->toArray());

        $this->get('/threads/'.$thread->id)->assertSee($reply->body);
    }
}
