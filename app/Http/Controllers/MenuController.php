<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
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

    public function widget_update($widget,$request)
    {
        $menu = Menus::find($request->menu);
        if($menu){
            $value = json_decode($widget->value);
            $value->id = $request->menu;
            
            $widget->value = json_encode($value);
            $widget->title = $request->title;
            $widget->save();
        }

        return $widget;
    }

    public function widget_view_backend($widget ,$view_type)
    {
        $menus = Menus::all();
        if ($view_type  == "widget" ) {
            return view($widget->widget_backend, [
                'widget' => $widget,
                'menus' => $menus
            ]);
        } elseif( $view_type  == "container_widget" ) {
            $value = json_decode($widget->value);
            $menu_id = $value->id;
            return view($widget->container_widget_backend, [
                'container_widget' => $widget,
                'menus' => $menus,
                'menu_id' => $menu_id
            ]);
        }
    }
}
