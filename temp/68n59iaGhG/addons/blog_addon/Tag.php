<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Tag extends Model
{
  protected $fillable = [
      'title'
    ];

  public function article_tag()
  {
      return $this->hasMany(ArticleTag::class, 'tag_id');
  }

  public static function boot() {
    parent::boot();

    static::deleting(function($tag) { // before delete() method call this
        $tag->article_tag->each->delete();
    });
  }
}
