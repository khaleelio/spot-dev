<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Category;

class MenuController extends Controller
{
    public function index()
    {
        $pages = Page::select('title','slug')->get();
        if(class_exists("App\Category")){
            $categories = Category::select('title','slug')->get();
            $data = [
                'pages'=>$pages,
                'categories'=>$categories,
            ];
        }else{
            $data = [
                'pages'=>$pages,
            ];
        }
        return view('backend.website_settings.menu.index', $data);
    }
}
