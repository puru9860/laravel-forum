<?php

namespace Tests\Feature;

use App\Models\Favorite;
use App\Models\Reply;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_guest_canot_favorite_anything()
    {
        $this->post('replies/1/favorites')
        ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();
        $reply = create(Reply::class);

        $this->post("/replies/{$reply->id}/favorites");

        $this->assertCount(1,$reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_may_only_favorite_a_reply_once()
    {
        $this->withoutExceptionHandling()->signIn();
        $reply = create(Reply::class);

        $this->post("/replies/{$reply->id}/favorites");
        $this->post("/replies/{$reply->id}/favorites");

        $this->assertCount(1,$reply->favorites);
    }
}
