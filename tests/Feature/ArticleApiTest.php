<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_filter_articles_by_category_array()
    {
        // 1. Arrange: Create dummy data
        Article::factory()->create(['title' => 'Tech News', 'category' => 'technology']);
        Article::factory()->create(['title' => 'Sports News', 'category' => 'sports']);
        Article::factory()->create(['title' => 'Cooking News', 'category' => 'cooking']);

        // 2. Act: Request two specific categories
        $response = $this->getJson('/api/articles?categories[]=technology&categories[]=sports');

        // 3. Assert
        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data') // Assuming pagination wraps data in 'data'
                 ->assertJsonFragment(['title' => 'Tech News'])
                 ->assertJsonFragment(['title' => 'Sports News'])
                 ->assertJsonMissing(['title' => 'Cooking News']);
    }

    public function test_can_search_articles_by_keyword()
    {
        Article::factory()->create(['title' => 'Bitcoin is rising']);
        Article::factory()->create(['title' => 'Gold is stable']);

        $response = $this->getJson('/api/articles?q=Bitcoin');

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Bitcoin is rising'])
                 ->assertJsonMissing(['title' => 'Gold is stable']);
    }
}