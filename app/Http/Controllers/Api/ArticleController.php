<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;


class ArticleController extends Controller {
    
    
    public function show(Article $article): ArticleResource { //tipo de respuesta ArticleResource
        
        return ArticleResource::make($article);
    }

    public function index(): ArticleCollection { //tipo de respuesta ArticleCollection
    
        return ArticleCollection::make(Article::all());
    }
}
