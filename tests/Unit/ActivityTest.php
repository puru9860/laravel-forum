<?php

namespace Tests\Unit;

use App\Models\Activity;
use App\Models\Reply;
use App\Models\Thread;
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
}
