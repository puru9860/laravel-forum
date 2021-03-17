<?php

namespace Tests\Unit;

use App\Models\Activity;
use App\Models\Reply;
use App\Models\Thread;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_records_activity_when_thread_is_created()
    {
        $this->signIn();
        $thread = create(Thread::class);

        $this->assertDatabaseHas('activities',[
            'type' => 'created_thread',
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => Thread::class,
        ]);
    }

    /** @test */
    public function it_records_activity_when_reply_is_created()
    {
        $this->signIn();
        create(Reply::class);

        $this->assertEquals(2,Activity::count());
    }

    /** @test */
    public function it_fetches_a_feed_for_any_user()
    {
        $this->signIn();

        create(Thread::class,['user_id'=> auth()->id()],2);

        auth()->user()->activity()->first()->update(['created_at' => Carbon::now()->subWeek()]);

        $feed =Activity::feed(auth()->user());
        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format('y-m-d'),
        ));
        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('y-m-d'),
        ));

    }
}
