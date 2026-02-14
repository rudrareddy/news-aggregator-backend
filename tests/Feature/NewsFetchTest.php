<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Models\Article;

class NewsFetchTest extends TestCase
{
    use RefreshDatabase; // Clears DB after each test

    public function test_news_fetch_command_saves_articles_to_database()
    {
        // 1. Mock the API responses
        Http::fake([
            'content.guardianapis.com/*' => Http::response([
                'response' => [
                    'results' => [
                        [
                            'webTitle' => 'Test Article',
                            'webUrl' => 'https://guardian.com/test',
                            'sectionName' => 'Tech',
                            'webPublicationDate' => now()->toIso8601String(),
                            'fields' => ['bodyText' => 'Content here', 'byline' => 'Author Name']
                        ]
                    ]
                ]
            ], 200),
            
        ]);

        // 2. Run the command
        $this->artisan('news:fetch')
             ->assertExitCode(0);

        // 3. Assert data is in DB
        $this->assertDatabaseHas('articles', [
            'title' => 'Test Article',
            'url' => 'https://guardian.com/test'
        ]);
    }
}