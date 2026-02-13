<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ArticleRepositoryInterface
{
    /**
     * Retrieve articles based on filter criteria.
     */
    public function getFilteredArticles(array $filters): LengthAwarePaginator;
}