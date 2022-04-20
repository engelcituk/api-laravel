<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;


class ArticleController extends Controller {
    
    
    public function index(): ArticleCollection { //tipo de respuesta ArticleCollection
    
        return ArticleCollection::make(Article::all());
    }

    public function show(Article $article): ArticleResource { //tipo de respuesta ArticleResource
        
        return ArticleResource::make($article);
    }

    public function create(Request $request) { //tipo de respuesta ArticleResource
        // dd($request->input('data.attributes'));
        $request->validate([
            'data.attributes.title' => ['required', 'min:4'],
            'data.attributes.slug' => ['required'],
            'data.attributes.content' => ['required'],
        ]);

        $article = Article::create([
            'title' => $request->input('data.attributes.title'),
            'slug' => $request->input('data.attributes.slug'),
            'content' => $request->input('data.attributes.content'),
        ]);

        return ArticleResource::make($article);
    }

}
