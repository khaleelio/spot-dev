<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
  protected $fillable = ['category_id', 'title', 'description', 'lang'];

  public function category(){
    return $this->belongsTo(Category::class);
  }
}
