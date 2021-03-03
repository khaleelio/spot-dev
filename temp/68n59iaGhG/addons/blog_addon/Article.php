<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Article extends Model
{
  protected $fillable = [
        'title','added_by', 'user_id', 'excerpt', 'content'
    ];

  public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $translation = $this->hasMany(ArticleTranslation::class)->where('lang', $lang)->first();
        return $translation != null ? $translation->$field : $this->$field;
  }

  public function article_translations(){
        return $this->hasMany(ArticleTranslation::class);
  }

  public function category_article()
  {
        return $this->hasMany(CategoryArticle::class, 'article_id');
  }

  public function article_tag()
  {
        return $this->hasMany(ArticleTag::class, 'article_id');
  }

  public function author(){
        return $this->belongsTo(User::class, 'user_id');
  }

  public static function boot() {
        parent::boot();

        static::deleting(function($article) { // before delete() method call this
            $article->category_article->each->delete();
            $article->article_tag->each->delete();
        });
  }

}
