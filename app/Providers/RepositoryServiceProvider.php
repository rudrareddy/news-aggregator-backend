<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\ArticleRepositoryInterface;
use App\Repositories\ArticleRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // This is the "Glue" that binds them
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
    }
}