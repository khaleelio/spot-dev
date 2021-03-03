<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessSetting;
use App\User;
use App\Tag;
use Session;
use Auth;
use DB;
use Mail;
use App\Http\Resources\TagCollection;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $col_name = null;
        $query = null;
        $author_id = null;
        $sort_search = null;
        $tags = Tag::orderBy('created_at', 'desc');
        if ($request->search != null){
            $tags = $tags
                        ->where('title', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        $tags = $tags->paginate(15);
        $type = 'All';

        return view('blog.backend.tags.index', compact('tags','col_name', 'query', 'sort_search'));
    }

    public function view(Request $request)
    {
        $col_name = null;
        $query = null;
        $author_id = null;
        $sort_search = null;
        $tags = Tag::orderBy('created_at', 'desc');
        if ($request->search != null){
            $tags = $tags
                        ->where('title', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        $tags = $tags->paginate(15);
        $type = 'All';

        return view('blog.backend.tags.view', compact('tags','col_name', 'query', 'sort_search'));
    }

    public function search(Request $request)
    {
        $tags = Tag::orderBy('created_at', 'desc');

        if ($request->title != null) {
            $tags = $tags->where('title', 'like', '%'.$request->title.'%');
        }

        $tags = new TagCollection($tags->paginate(16));
        return $tags;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.backend.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2|max:255',
            'slug' => 'required|unique:tags|min:2|max:255',
        ]);

        $tag = new Tag;
        $tag->title = $request->title;
        if (Tag::where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            $tag->slug             = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $tag->save();
            
            flash(translate('New tag has been created successfully'))->success();
            return redirect()->route('admin.tags.index');
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
        $tag_name = $request->tag;
        $tag = Tag::where('id', $id)->first();
        if($tag != null){
            return view('blog.backend.tags.edit', compact('tag','lang'));
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
        $request->validate([
            'title' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
        ]);
        $tag = Tag::findOrFail($id);
        if (Tag::where('id','!=', $id)->where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            if($tag->lang == env("DEFAULT_LANGUAGE")){
                $tag->title             = $request->title;
            }
            $tag->slug             = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $tag->save();

            flash(translate('Tag has been updated successfully'))->success();
            return redirect()->route('admin.tags.index');
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
        $tag = Tag::findOrFail($id);
        // if(Tag::destroy($id)){
        if($tag->delete()){
            flash(translate('Tag has been deleted successfully'))->success();
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
            if(Tag::select('slug')->where('slug', 'like', $slug.'%')->where('id','<>', $request->id)->count() > 0){
                for ($i = 1; $i <= 10; $i++) {
                    $newSlug = $slug.'-'.$i;
                    if(Tag::select('slug')->where('slug', 'like', $newSlug.'%')->where('id','<>', $request->id)->count() < 1){
                        return response()->json(['slug' => $newSlug]);
                    }
                }
            }else{
                return response()->json(['slug' => $slug]);
            }
        }else{
            if(Tag::select('slug')->where('slug', 'like', $slug.'%')->count() > 0){
                for ($i = 1; $i <= 10; $i++) {
                    $newSlug = $slug.'-'.$i;
                    if(Tag::select('slug')->where('slug', 'like', $newSlug.'%')->count() < 1){
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
