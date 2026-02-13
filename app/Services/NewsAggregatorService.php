<?php
namespace App\Services;
use App\Services\NewsSources\GuardianService;
use App\Services\NewsSources\NewsApiService;
use App\Services\NewsSources\NYTApiService;
class NewsAggregatorService
{
    protected array $sources;

    public function __construct(
        GuardianService $guardian, 
        NYTApiService $nyt, 
        NewsApiService $newsApi
    ) {
        $this->sources = [$nyt,$guardian,$newsApi];
    }

    public function run()
    {
        foreach ($this->sources as $source) {
            try {
                $articles = $source->fetchArticles();
                //dd($articles);
                $this->store($articles);
            } catch (\Exception $e) {
                // Log error but continue to next source
                \Log::error("Failed to fetch from source: " . $e->getMessage());
            }
        }
    }

    protected function store(array $articles)
    {
        //dd($articles);
        foreach ($articles as $articleData) {
            // updateOrCreate prevents duplicates based on the unique URL
            \App\Models\Article::updateOrCreate(
                ['url' => $articleData['url']],
                $articleData
            );
        }
    }
}