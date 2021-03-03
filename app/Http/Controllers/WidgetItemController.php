<?php

namespace App\Http\Controllers;
use App\AdminWidget;
use App\AdminWidgetItem;

use Illuminate\Http\Request;

class WidgetItemController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2|max:255',
            'body' => 'required|max:65500',
            'link' => 'nullable|max:255',
            'sort' => 'nullable|integer',
            'class' => 'nullable|max:255',
            'widget_id' => 'required|exists:admin_widgets,id',
            'depth' => 'nullable|integer',
        ]);
        $widget = AdminWidget::find($request->widget_id);
        $sort = ($widget->item->last()->sort ?? -1) + 1 ;

        $item = new AdminWidgetItem();
        $item->title = $request->title;
        $item->body = $request->body;
        $item->link = $request->link ?? '';
        $item->sort = $sort;
        $item->class = $request->class ?? '';
        $item->widget_id = $request->widget_id;
        $item->depth = $request->depth ?? 0;
        $item->save();

        flash(translate('New item has been created successfully'))->success();
        return redirect()->route('website.widget.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:admin_widget_items,id',
            'title' => 'required|min:2|max:255',
            'body' => 'required|max:65500',
            'link' => 'nullable|max:255',
            'sort' => 'nullable|integer',
            'class' => 'nullable|max:255',
            'widget_id' => 'required|exists:admin_widgets,id',
            'depth' => 'nullable|integer',
        ]);
        $item = new AdminWidgetItem();
        $item->title = $request->title;
        $item->body = $request->body;
        $item->link = $request->link;
        $item->sort = $request->sort;
        $item->class = $request->class;
        $item->widget_id = $request->widget_id;
        $item->depth = $request->depth;
        $item->save();

        flash(translate('New item has been created successfully'))->success();
        return redirect()->route('website.widget.index');
    }

    public function position(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*' => 'required|exists:admin_widget_items,id',
            'widget_id' => 'required|exists:admin_widgets,id',
            'sort' => 'nullable|integer',
        ]);
        foreach ($request->items as $key => $item_id) {
            $item = AdminWidgetItem::find($item_id);
            $item->widget_id = $request->widget_id;
            $item->sort = $key;
            $item->save();
        }
        return "Item has been updated successfully!";
    }

    public function destroy($id)
    {
        $item = AdminWidgetItem::findOrFail($id);
        $item->delete();
        flash(translate('Item has been deleted successfully'))->success();
        return redirect()->back();
    }
}
