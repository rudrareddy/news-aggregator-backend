<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleRepository
{
    /**
     * Get filtered articles based on request parameters.
     */
    public function getFilteredArticles(array $filters): LengthAwarePaginator
    {
        $query = Article::query();

        // 1. Search (Title/Description)
        if (!empty($filters['q'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['q'] . '%')
                  ->orWhere('description', 'like', '%' . $filters['q'] . '%');
            });
        }

        // 2. Filter by Category (Individual or Preference Array)
        if (!empty($filters['categories'])) {
            $categories = is_array($filters['categories']) ? $filters['categories'] : [$filters['categories']];
            $query->whereIn('category', $categories);
        }

        // 3. Filter by Authors (Preference Array)
        if (!empty($filters['authors'])) {
            $authors = is_array($filters['authors']) ? $filters['authors'] : [$filters['authors']];
            $query->whereIn('author', $authors);
        }

        // 4. Filter by Sources
        if (!empty($filters['sources'])) {
            $sources = is_array($filters['sources']) ? $filters['sources'] : [$filters['sources']];
            $query->whereIn('source_name', $sources);
        }

        // 5. Filter by Date
        if (!empty($filters['date'])) {
            $query->whereDate('published_at', $filters['date']);
        }

        return $query->latest('published_at')->paginate(15);
    }
}