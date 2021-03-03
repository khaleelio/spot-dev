<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class CategoryArticle extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
