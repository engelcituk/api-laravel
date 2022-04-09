<?php

namespace Tests\Feature\Articles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Article;
use Illuminate\Support\Str;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_articles(){
        $this->withoutExceptionHandling();

        $response = $this->postJson( route('api.v1.articles.create'),[
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'Nuevo articulo',
                    'slug' => Str::slug('Nuevo articulo'),
                    'content' => 'Contenido del árticulo'
                ]
            ]
        ])->assertCreated();

        $response->assertCreated();

        $article = Article::first();// obtengo el unico articulo registrado en la BD
        // dd($article );
        $response->assertHeader(
            'Location',
            route('api.v1.articles.show', $article)
        );

        $response->assertExactJson([
            'data' => [
                'type' => 'articles',
                'id' => (string) $article->getRouteKey(),
                'attributes' => [
                    'title' => $article->title,
                    'slug' => $article->content, //sigo sin entender porque no coincide aqui
                    'content' => $article->content
                ],
                'links' => [
                    'self' => route('api.v1.articles.show', $article)
                ]
            ] 
         ]);
    }
}
