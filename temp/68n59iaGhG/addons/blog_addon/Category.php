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
    
    public function category_article()
    {
        return $this->hasMany(CategoryArticle::class, 'category_id');
    }

    public function category_translations(){
        return $this->hasMany(CategoryTranslation::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($category) { // before delete() method call this
            $category->children->each->delete();
            $category->category_article->each->delete();
        });
}

}
