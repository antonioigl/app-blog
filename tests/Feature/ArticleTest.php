<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function factory;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->article = factory(Article::class)->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function it_shows_a_collection_of_articles()
    {
        $this->json('GET', "/api/articles?api_token={$this->user->api_token}")
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $this->article->id,
                        'attributes' => [
                            'title' => $this->article->title,
                            'description' => $this->article->content,
                            'picture' => $this->article->thumbnail,
                            'created_at' => $this->article->created_at->diffForHumans(),
                        ]
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_shows_an_article()
    {
        $this->json('GET', "/api/articles/{$this->article->slug}?api_token={$this->user->api_token}")
            ->assertStatus(200)
            ->assertJson([

                'id' => $this->article->id,
                'attributes' => [
                    'title' => $this->article->title,
                    'description' => $this->article->content,
                    'picture' => $this->article->thumbnail,
                    'created_at' => $this->article->created_at->diffForHumans(),

                ]
            ]);
    }

    /** @test */
    public function it_creates_a_single_article()
    {
        //$this->withoutExceptionHandling();
        $this->assertEquals(1, Article::count());

        $data = [
            'title' => 'lorem insu dolor',
            'content' => 'lorem insu dolor',
            'thumbnail' => 'https://picsum.photos/250/500',
            'api_token' => $this->user->api_token,
        ];

        $this->json('POST', '/api/articles', $data)
            ->assertStatus(201);

        $this->assertEquals(2, Article::count());

    }


    /** @test */
    public function the_owner_can_delete_the_Article_fails()
    {
        $user = factory(User::class)->create();

        $this->json('DELETE', "api/articles/{$this->article->slug}", ['api_token' => $user->api_token])
            ->assertStatus(403);

    }

    /** @test */
    public function it_deletes_an_article()
    {
        $this->json('DELETE', "api/articles/{$this->article->slug}", ['api_token' => $this->user->api_token])
            ->assertStatus(204);

        $this->assertNull(Article::find($this->article->id));

    }
}
