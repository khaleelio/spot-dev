<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminWidget;
use App\AdminWidgetItem;

class WidgetController extends Controller
{
    public function index()
    {
        $widgets = AdminWidget::all();
        // return $widgets;
        return view('backend.widget.index',['widgets'=>$widgets]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2|max:255',
        ]);
        $widget = new AdminWidget();
        $widget->title = $request->title;
        $widget->save();

        flash(translate('New widget has been created successfully'))->success();
        return redirect()->route('website.widget.index');
    }
}
