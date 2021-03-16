<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations,DatabaseTransactions;

    /** @test */
    public function guest_may_not_create_threads()
    {
        $thread = make(Thread::class);

        $this->post('/threads', $thread->toArray())->assertRedirect('login');
        $this->get(route('threads.create'))->assertRedirect('login');
    }


    /**
     * @test
     */
    public function an_authenticated_user_can_create_forum_thread()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $thread = make(Thread::class);

        $response = $this->post(route('threads.store', $thread->toArray()));

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_requires_a_valid_channel()
    {
        $channel = Channel::factory()->times(5)->create();
        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 100])
            ->assertSessionHasErrors('channel_id');
    }

    /** @test */
    public function unauthorized_user_may_not_delete_thread()
    {
        $thread = create(Thread::class);

        $this->delete($thread->path())
        ->assertRedirect('/login');

        $this->signIn();
        $this->delete($thread->path())
        ->assertStatus(403);
    }

    /** @test */
    public function authorized_user_can_delete_thread()
    {
        $this->signIn();

        $thread = create(Thread::class,['user_id' => auth()->id()]);
        $reply = create(Reply::class,['thread_id' => $thread->id]);

        $this->delete($thread->path());
        $this->assertDatabaseMissing('threads',['id'=>$thread->id]);
        $this->assertDatabaseMissing('replies',['id'=>$reply->id]);

    }


    protected function publishThread($overrides = [])
    {
        $this->signIn();
        $thread = make(Thread::class, $overrides);

        return $this->post('/threads', $thread->toArray());
    }

    // test
}
