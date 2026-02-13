<?php
namespace App\Services\NewsSources;

use App\Interfaces\NewsSourceInterface;
use Illuminate\Support\Facades\Http;

class GuardianService implements NewsSourceInterface
{
    public function fetchArticles(): array
    {
        $response = Http::get('https://content.guardianapis.com/search', [
            'api-key' => config('news-source.guardian.key'),
            'show-fields' => 'thumbnail,bodyText,byline',
            'page-size' => 10,
        ]);
        return $this->transform($response->json()['response']['results'] ?? []);
    }

    public function transform(array $data): array
    {
        // Transform Guardian's specific format to our Unified format
        return array_map(function ($article) {
            return [
                'title' => $article['webTitle'],
                'description' => null, // Guardian search doesn't always provide summary
                'content' => $article['fields']['bodyText'] ?? '',
                'author' => $article['fields']['byline'] ?? 'The Guardian',
                'source_name' => 'The Guardian',
                'category' => $article['sectionName'],
                'url' => $article['webUrl'],
                'image_url' => $article['fields']['thumbnail'] ?? null,
                'published_at' => date('Y-m-d h:i',strtotime($article['webPublicationDate'])),
                'api_provider' => 'guardian',
            ];
        }, $data);
    }
}