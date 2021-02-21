<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
  protected $fillable = ['article_id', 'title', 'content', 'lang'];

  public function article(){
    return $this->belongsTo(Article::class);
  }
}
