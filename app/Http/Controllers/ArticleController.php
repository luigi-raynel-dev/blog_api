<?php

namespace App\Http\Controllers;

use App\Models\Article as Article;
use App\Http\Resources\Article as ArticleResource;
use Illuminate\Http\Request;

class ArticleController extends Controller {

  public function index(){
    $articles = Article::paginate(15);
    return ArticleResource::collection($articles);
  }

  public function show($id){
    $article = Article::findOrFail( $id );
    return new ArticleResource( $article );
  }

  public function store(Request $request){
    $article = new Article;
    $article->title = $request->input('title');
    $article->content = $request->input('content');

    if( $article->save() ){
      return new ArticleResource( $article );
    }
  }

   public function update(Request $request){
    $article = Article::findOrFail( $request->id );
    $article->title = $request->input('title');
    $article->content = $request->input('content');

    if( $article->save() ){
      return new ArticleResource( $article );
    }
  } 

  public function destroy($id){
    $article = Article::findOrFail( $id );
    if( $article->delete() ){
      return new ArticleResource( $article );
    }

  }
}