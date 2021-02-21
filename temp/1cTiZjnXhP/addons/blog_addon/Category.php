<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Category extends Model
{
  protected $fillable = [
      'title','description'
    ];

  public function getTranslation($field = '', $lang = false){
      $lang = $lang == false ? App::getLocale() : $lang;
      $translation = $this->hasMany(CategoryTranslation::class)->where('lang', $lang)->first();
      return $translation != null ? $translation->$field : $this->$field;
  }

  public function category_translations(){
    return $this->hasMany(CategoryTranslation::class);
  }

}
