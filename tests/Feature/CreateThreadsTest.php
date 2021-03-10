<?php

namespace Tests\Feature;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guest_may_not_create_threads()
    {
        $thread = make(Thread::class);

        $this->post('/threads',$thread->toArray())->assertRedirect('login');
        $this->get(route('threads.create'))->assertRedirect('login');

    }


    /**
     * @test
     */
    public function an_authenticated_user_can_create_forum_thread()
    {
        $this->signIn();

        $thread = make(Thread::class);

        $this->post('/threads',$thread->toArray());

        $this->get('/threads'.$thread->id)->assertSee($thread->title);
    }
}
 