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

    public function destroy($id)
    {
        $widget = AdminWidget::findOrFail($id);
        if(count($widget->item) == 0){
            $widget->delete();
        }else{
            flash(translate("You can't delete this widget , you have to delete or move all items first"))->error();
            return redirect()->back();
        }
        flash(translate('Item has been deleted successfully'))->success();
        return redirect()->back();
    }
}
