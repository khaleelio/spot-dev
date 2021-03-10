<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminTheme;

class AdminThemeController extends Controller
{
    public function index()
    {
        $themes = AdminTheme::all();
        return view('backend.theme.index', ['themes'=>$themes]);
    }

    public function update_active(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:admin_themes,id', // container_widget belongs to this widget 
        ]);
        $active_themes = AdminTheme::where('active','=',1)->get();
        foreach ($active_themes as $active_theme) {
            $active_theme->active = 0;
            $active_theme->save();
        }
        $theme = AdminTheme::find($request->id);
        $theme->active = 1;
        $theme->save();
        flash(translate('This theme is activated successfully'))->success();
        return redirect()->back();
    }
}
