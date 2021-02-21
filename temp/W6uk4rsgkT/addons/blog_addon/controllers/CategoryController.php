<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessSetting;
use App\User;
use App\Category;
use App\CategoryTranslation;
use Session;
use Auth;
use DB;
use Mail;
use App\Http\Resources\CategoryCollection;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $col_name = null;
        $query = null;
        $author_id = null;
        $sort_search = null;
        $categories = Category::orderBy('created_at', 'desc');
        if ($request->search != null){
            $categories = $categories
                        ->where('title', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        $categories = $categories->paginate(15);
        $type = 'All';

        return view('blog.backend.categories.index', compact('categories','col_name', 'query', 'sort_search'));
    }

    public function view(Request $request)
    {
        $col_name = null;
        $query = null;
        $author_id = null;
        $sort_search = null;
        $categories = Category::orderBy('created_at', 'desc');
        if ($request->search != null){
            $categories = $categories
                        ->where('title', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        $categories = $categories->paginate(15);
        $type = 'All';

        return view('blog.backend.categories.view', compact('categories','col_name', 'query', 'sort_search'));
    }

    public function search(Request $request)
    {
        $categories = Category::orderBy('created_at', 'desc');

        if ($request->title != null) {
            $categories = $categories->where('title', 'like', '%'.$request->title.'%');
        }

        $categories = new CategoryCollection($categories->paginate(16));
        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->title = $request->title;
        if (Category::where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            $category->slug             = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $category->thumb            = $request->thumb;
            $category->description            = $request->description;
            $category->meta_title            = $request->meta_title;
            $category->meta_description            = $request->meta_description;
            $category->keywords            = $request->keywords;
            $category->meta_image            = $request->meta_image;
            $category->save();

            $category_translation           = CategoryTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'category_id' => $category->id]);
            $category_translation->title    = $request->title;
            $category_translation->description    = $request->description;
            $category_translation->meta_title    = $request->meta_title;
            $category_translation->meta_description    = $request->meta_description;
            $category_translation->keywords    = $request->keywords;
            $category_translation->save();
            
            flash(translate('New category has been created successfully'))->success();
            return redirect()->route('admin.categories.index');
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
        $category_name = $request->category;
        $category = Category::where('id', $id)->first();
        if($category != null){
            return view('blog.backend.categories.edit', compact('category','lang'));
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
        $category = Category::findOrFail($id);
        if (Category::where('id','!=', $id)->where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            if($request->lang == env("DEFAULT_LANGUAGE")){
                $category->title             = $request->title;
            }
            $category->slug             = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $category->thumb            = $request->thumb;
            $category->description            = $request->description;
            $category->meta_title            = $request->meta_title;
            $category->meta_description            = $request->meta_description;
            $category->keywords            = $request->keywords;
            $category->meta_image            = $request->meta_image;
            $category->save();

            $category_translation           = CategoryTranslation::firstOrNew(['lang' => $request->lang, 'category_id' => $category->id]);
            $category_translation->title    = $request->title;
            $category_translation->description    = $request->description;
            $category_translation->meta_title    = $request->meta_title;
            $category_translation->meta_description    = $request->meta_description;
            $category_translation->keywords    = $request->keywords;
            $category_translation->save();

            flash(translate('Category has been updated successfully'))->success();
            return redirect()->route('admin.categories.index');
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
        $category = Category::findOrFail($id);
        if($category->category_translation){
            foreach ($category->category_translation as $key => $category_translation) {
                $category_translation->delete();
            }
        }
        if(Category::destroy($id)){
            flash(translate('Category has been deleted successfully'))->success();
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
            if(Category::select('slug')->where('slug', 'like', $slug.'%')->where('id','<>', $request->id)->count() > 0){
                for ($i = 1; $i <= 10; $i++) {
                    $newSlug = $slug.'-'.$i;
                    if(Category::select('slug')->where('slug', 'like', $newSlug.'%')->where('id','<>', $request->id)->count() < 1){
                        return response()->json(['slug' => $newSlug]);
                    }
                }
            }else{
                return response()->json(['slug' => $slug]);
            }
        }else{
            if(Category::select('slug')->where('slug', 'like', $slug.'%')->count() > 0){
                for ($i = 1; $i <= 10; $i++) {
                    $newSlug = $slug.'-'.$i;
                    if(Category::select('slug')->where('slug', 'like', $newSlug.'%')->count() < 1){
                        return response()->json(['slug' => $newSlug]);
                    }
                }
            }else{
                return response()->json(['slug' => $slug]);
            }
        }

        throw new \Exception(translate('Can not create a unique slug'));
    }
}
