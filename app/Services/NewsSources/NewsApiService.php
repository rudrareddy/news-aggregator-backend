<?php
namespace App\Services\NewsSources;

use App\Interfaces\NewsSourceInterface;
use Illuminate\Support\Facades\Http;

class NewsApiService implements NewsSourceInterface
{
    public function fetchArticles(): array
    {
        $response = Http::withHeaders([
            'X-Api-Key' => config('news-source.newsapi.key'),
        ])->get('https://newsapi.org/v2/top-headlines', [
            'language' => 'en',
            'pageSize' => 10,
        ]);
        //dd($response->json());
        return $this->transform($response->json()['articles'] ?? []);
    }

    public function transform(array $data): array
    {
        // Transform Guardian's specific format to our Unified format
       // dd($data);
        return array_map(function ($article) {
            //dd($article['title']);
            return [
                'title' => $article['title'],
                'description' => $article['description'], // Guardian search doesn't always provide summary
                'content' => $article['content'] ?? '',
                'author' => $article['author'] ?? 'NewsApi org',
                'source_name' => 'NewsApi Org',
                'category' => $article['source']['name'],
                'url' => $article['url'],
                'image_url' => $article['urlToImage'] ?? null,
                'published_at' => date('Y-m-d h:i',strtotime($article['publishedAt'])),
                'api_provider' => 'newsapi.org',
            ];
        }, $data);
    }
}