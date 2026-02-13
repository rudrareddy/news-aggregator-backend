<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
class ArticleController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function index(Request $request)
    {
        // Pass all request data to the repository
        $articles = $this->articleRepository->getFilteredArticles($request->all());
        return ArticleResource::collection($articles);
    }
}