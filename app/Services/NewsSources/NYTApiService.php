<?php
namespace App\Services\NewsSources;

use App\Interfaces\NewsSourceInterface;
use Illuminate\Support\Facades\Http;

class NYTApiService implements NewsSourceInterface
{
    public function fetchArticles(): array
    {
        $response = Http::get('https://api.nytimes.com/svc/topstories/v2/technology.json', [
            'api-key' => config('news-source.nytimes.key'),
        ]);
        //dd($response->json());
        return $this->transform($response->json()['results'] ?? []);
    }

    public function transform(array $data): array
    {
        // Transform Guardian's specific format to our Unified format
        //dd($data);
        return array_map(function ($article) {
           // dd($article['multimedia'][0]['url']);
            return [
                'title' => $article['title'],
                'description' => $article['description'] ?? null, // NYT search doesn't always provide summary
                'content' => $article['abstract'] ?? '',
                'author' => $article['byline'] ?? 'NYTimes',
                'source_name' => 'New York Times',
                'category' => $article['section'],
                'url' => $article['url'],
                'image_url' => $article['multimedia'][0]['url'] ?? null,
                'published_at' => date('Y-m-d h:i',strtotime($article['published_date'])),
                'api_provider' => 'nytimes',
            ];
        }, $data);
    }
}