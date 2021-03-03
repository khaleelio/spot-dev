<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class ArticleTag extends Model
{
    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
