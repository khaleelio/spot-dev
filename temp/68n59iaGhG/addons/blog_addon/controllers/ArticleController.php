<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessSetting;
use App\User;
use App\Article;
use App\ArticleTranslation;
use App\Category;
use App\CategoryArticle;
use App\ArticleTag;
use App\Tag;
use Session;
use Auth;
use DB;
use Mail;
use App\Http\Resources\ArticleCollection;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $col_name = null;
        $query = null;
        $author_id = null;
        $sort_search = null;
        $articles = Article::orderBy('created_at', 'desc');
        if ($articles->has('author') && isset($articles->user_id) && $articles->user_id != null) {
            $articles = $articles('user_id', $request->user_id);
            $author_id = $articles->user_id;
        }
        if ($request->search != null){
            $articles = $articles
                        ->where('title', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }
        if ($request->type != null){
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $articles = $articles->orderBy($col_name, $query);
            $sort_type = $request->type;
        }

        $articles = $articles->paginate(15);
        $type = 'All';

        return view('blog.backend.articles.index', compact('articles','type', 'col_name', 'query', 'author_id', 'sort_search'));
    }

    public function search(Request $request)
    {
        if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
            $articles = Article::where('added_by', 'admin')->where('published', '1');
        }
        else {
            $articles = Article::where('user_id', Auth::user()->id)->where('published', '1');
        }

        if($request->category != null){
            $arr = explode('-', $request->category);
            if($arr[0] == 'category'){
                $category_ids = CategoryUtility::children_ids($arr[1]);
                $category_ids[] = $arr[1];
                // TODO : Filter by category
                //$articles = $articles->whereIn('category_id', $category_ids);
            }
        }

        if($request->tags != null){
            $arr = explode('-', $request->tags);
            if($arr[0] == 'tags'){
                $category_ids = CategoryUtility::children_ids($arr[1]);
                $category_ids[] = $arr[1];
                // TODO : Filter by tags
                //$articles = $articles->whereIn('category_id', $category_ids);
            }
        }

        if ($request->title != null) {
            $articles = $articles->where('title', 'like', '%'.$request->title.'%')->orWhere('excerpt', 'like', '%'.$request->title.'%')->orderBy('created_at', 'desc');
        }

        $articles = new ArticleCollection($articles->paginate(16));
        return $articles;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id','=',null)->orderBy('created_at', 'desc')->get();
        // return $categories[2]->children;
        $tags = Tag::orderBy('created_at', 'desc')->get();
        return view('blog.backend.articles.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'title' => 'required|min:2|max:255',
            'slug' => 'required|unique:articles|min:2|max:255',
            'type' => 'required|min:2|max:255',
            'excerpt' => 'nullable|max:65500',
            'content' => 'required|max:65500',
            'published' => 'required|max:255',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255',
            'keywords' => 'nullable|max:65500',
        ]);
        // return $request;

        $article = new Article;
        $article->title = $request->title;
        if (Article::where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            $article->slug             = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $article->type             = $request->type;
            $article->excerpt          = $request->excerpt;
            $article->content          = $request->content;
            $article->featured_image   = $request->featured_image;
            $article->video_link       = $request->video_link;
            $article->voice_link       = $request->voice_link;
            $article->gallery          = $request->gallery;
            $article->meta_title       = $request->meta_title;
            $article->meta_description = $request->meta_description;
            $article->keywords         = $request->keywords;
            $article->meta_image       = $request->meta_image;
            $article->published        = $request->published;
            $article->added_by         = Auth::user()->id;
            $article->user_id          = Auth::user()->id;
            //$article->options          = $request->options;
            $article->save();

            $article_translation           = ArticleTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'article_id' => $article->id]);
            $article_translation->title    = $request->title;
            $article_translation->excerpt  = $request->excerpt;
            $article_translation->content  = $request->content;
            $article_translation->meta_title  = $request->meta_title;
            $article_translation->meta_description  = $request->meta_description;
            $article_translation->keywords  = $request->keywords;
            $article_translation->save();

            foreach ($request->categories ?? [] as $category_id) {
                $category_article = new CategoryArticle;
                $category_article->article_id = $article->id;
                $category_article->category_id = $category_id;
                $category_article->save();
            }

            $tags = json_decode($request->tags[0]);
            foreach ($tags ?? [] as $tag) {
                if( Tag::find( (int)($tag->id ?? "0") ) ){
                    $article_tag = new ArticleTag;
                    $article_tag->article_id = $article->id;
                    $article_tag->tag_id = (int)$tag->id;
                    $article_tag->save();
                }else{
                    $new_tag = new Tag;
                    $new_tag->title = $tag->value;
                    $new_tag->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $new_tag->title));
                    if (Tag::where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $new_tag->slug)))->first() == null) {
                        $new_tag->save();
                        
                        $article_tag = new ArticleTag;
                        $article_tag->article_id = $article->id;
                        $article_tag->tag_id = $new_tag->id;
                        $article_tag->save();
                    }
                }
            }
            
            flash(translate('New article has been created successfully'))->success();
            return redirect()->route('admin.articles.index');
        }

        flash(translate('Slug has been used already'))->warning();
        return back()->withInput($request->input());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit(Request $request, $id)
   {
        $lang = $request->lang;
        $article_name = $request->article;
        $article = Article::where('id', $id)->with('category_article')->with('article_tag')->first();
        if($article != null){
            $categories = Category::where('parent_id','=',null)->orderBy('created_at', 'desc')->get();
            $tags = Tag::orderBy('created_at', 'desc')->get();
            $article->categories = $article->category_article->pluck('category_id')->toArray(); 
            $article->tags = $article->article_tag->pluck('tag_id')->toArray(); 
            // return $article;
            return view('blog.backend.articles.edit', compact('article','lang','categories','tags'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $request->validate([
            'title' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
            'type' => 'required|min:2|max:255',
            'excerpt' => 'nullable|max:65500',
            'content' => 'required|max:65500',
            'published' => 'required|max:255',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255',
            'keywords' => 'nullable|max:65500',
        ]);

        $article = Article::with('category_article')->with('article_tag')->findOrFail($id);
        if (Article::where('id','!=', $id)->where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            if($request->lang == env("DEFAULT_LANGUAGE")){
                $article->title             = $request->title;
                $article->content           = $request->content;
                $article->excerpt           = $request->excerpt;
                $article->content           = $request->content;
                $article->meta_title        = $request->meta_title;
                $article->meta_description  = $request->meta_description;
                $article->keywords          = $request->keywords;
            }
            $article->slug             = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $article->type             = $request->type;
            $article->featured_image   = $request->featured_image;
            $article->video_link       = $request->video_link;
            $article->voice_link       = $request->voice_link;
            $article->gallery          = $request->gallery;
            $article->meta_image       = $request->meta_image;
            $article->published        = $request->published;
            $article->added_by          = Auth::user()->id;
            $article->user_id           = Auth::user()->id;
            $article->save();

            $request_categories = $request->categories ?? [];
            foreach ($article->category_article as $category_article) {
                if(!in_array($category_article->category_id,$request_categories)){
                    $category_article->delete();
                }
            }

            $article->categories = $article->category_article->pluck('category_id')->toArray();
            foreach ($request_categories as $category_id) {
                if(!in_array( $category_id , $article->categories )){
                    $category_article = new CategoryArticle;
                    $category_article->article_id = $article->id;
                    $category_article->category_id = $category_id;
                    $category_article->save();
                }
            }


            $request_tags = json_decode($request->tags[0]) ?? [];
            $request_tag_ids = array_column($request_tags, 'id');
            // return $request_tags;
            foreach ($article->article_tag as $article_tag) {
                if(!in_array($article_tag->tag_id,$request_tag_ids)){
                    $article_tag->delete();
                }
            }

            $article->tags = $article->article_tag->pluck('tag_id')->toArray();
            foreach ($request_tags as $tag) {
                if(!in_array( (int)($tag->id ?? "0") , $article->tags )){
                    if( Tag::find( (int)($tag->id ?? "0") ) ){
                        $article_tag = new ArticleTag;
                        $article_tag->article_id = $article->id;
                        $article_tag->tag_id = (int)$tag->id;
                        $article_tag->save();
                    }else{
                        $new_tag = new Tag;
                        $new_tag->title = $tag->value;
                        $new_tag->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $new_tag->title));
                        if (Tag::where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $new_tag->slug)))->first() == null) {
                            $new_tag->save();
                            
                            $article_tag = new ArticleTag;
                            $article_tag->article_id = $article->id;
                            $article_tag->tag_id = $new_tag->id;
                            $article_tag->save();
                        }
                    }
                }
            }

            $article_translation           = ArticleTranslation::firstOrNew(['lang' => $request->lang, 'article_id' => $article->id]);
            $article_translation->title    = $request->title;
            $article_translation->excerpt  = $request->excerpt;
            $article_translation->content  = $request->content;
            $article_translation->meta_title  = $request->meta_title;
            $article_translation->meta_description  = $request->meta_description;
            $article_translation->keywords  = $request->keywords;
            $article_translation->save();

            flash(translate('Article has been updated successfully'))->success();
            return redirect()->route('admin.articles.index');
        }

      flash(translate('Slug has been used already'))->warning();
      return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if($article->article_translation){
            foreach ($article->article_translation as $key => $article_translation) {
                $article_translation->delete();
            }
        }
        if($article->delete()){
            flash(translate('Article has been deleted successfully'))->success();
            return redirect()->back();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkslug(Request $request)
    {
        $slug = Str::slug($request->title);

        if(isset($request->id)){
            if(Article::select('slug')->where('slug', 'like', $slug.'%')->where('id','<>', $request->id)->count() > 0){
                for ($i = 1; $i <= 10; $i++) {
                    $newSlug = $slug.'-'.$i;
                    if(Article::select('slug')->where('slug', 'like', $newSlug.'%')->where('id','<>', $request->id)->count() < 1){
                        return response()->json(['slug' => $newSlug]);
                    }
                }
            }else{
                return response()->json(['slug' => $slug]);
            }
        }else{
            if(Article::select('slug')->where('slug', 'like', $slug.'%')->count() > 0){
                for ($i = 1; $i <= 10; $i++) {
                    $newSlug = $slug.'-'.$i;
                    if(Article::select('slug')->where('slug', 'like', $newSlug.'%')->count() < 1){
                        return response()->json(['slug' => $newSlug]);
                    }
                }
            }else{
                return response()->json(['slug' => $slug]);
            }
        }

        throw new \Exception(translate('Can not create a unique slug'));
    }

    public function publish(Request $request)
    {
        $article = Article::find($request->id);
        $article->published = $request->status;
        $article->save();

        return 1;
    }
}
