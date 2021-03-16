<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminContainer;
use App\AdminContainerWidget;
use App\AdminWidget;

class AdminWidgetController extends Controller
{
    public function store($request)
    {
        $widget = new AdminWidget();
        $widget->title = $request['title'] ?? '';
        $widget->name = $request['name'] ?? '';
        $widget->value = $request['value'] ?? '';
        $widget->link = $request['link'] ?? '';
        $widget->class = $request['class'] ?? '';
        $widget->type = $request['type'] ?? '';
        $widget->object = $request['object'] ?? '';
        $widget->save();

        // flash(translate('New widget has been created successfully'))->success();
        return $widget;
    }

    public function update($request)
    {
        $widget = AdminWidget::find($request['id']);
        if($widget){
            $widget->title = $request['title'] ?? $widget->title;
            $widget->name = $request['name'] ?? $widget->name;
            $widget->value = $request['value'] ?? $widget->value;
            $widget->link = $request['link'] ?? $widget->link;
            $widget->class = $request['class'] ?? $widget->class;
            $widget->type = $request['type'] ?? $widget->type;
            $widget->object = $request['object'] ?? $widget->object;
            $widget->save();
            return $widget;
        }else{
            return translate('Invalid ID');
        }
    }

    public function destroy($id)
    {
        $widget = AdminWidget::find($id);
        if($widget){
            $widget->delete();
            return translate('Widget has been deleted successfully');
        }else{
            return translate('Invalid ID');
        }
    }

    public function clone(Request $request)
    {
        $request->validate([
            'container_widgets' => 'required|array',
            // 'container_widgets.*' => 'required|exists:admin_container_widgets,id',
            'widget_id' => 'required|exists:admin_widgets,id', // container_widget belongs to this widget 
            'container_id' => 'required|exists:admin_containers,id',
            'source' => 'nullable|exists:admin_containers,id',
        ]);
        // return $request;
        $new_container_widget_id = 0;

        foreach ($request->container_widgets as $key => $container_widget_id) {
            $container_widget = AdminContainerWidget::find($container_widget_id);
            if($container_widget){
                // return $container_widget;
                $container_widget->container_id = $request->container_id;
                $container_widget->sort = $key;
                $container_widget->save();
            }else{
                $widget = AdminWidget::find($request->widget_id); // container_widget belongs to this widget 
                $container_widget = new AdminContainerWidget();
                $container_widget->title = $widget->title;
                $container_widget->name = $widget->name;
                $container_widget->value = $widget->value;
                $container_widget->link = $widget->link;
                $container_widget->sort = $key;
                $container_widget->class = $widget->class;
                $container_widget->type = $widget->type;
                $container_widget->object = $widget->object;
                $container_widget->widget_id = $widget->id;
                $container_widget->container_id = $request->container_id;
                // return $container_widget;
                $container_widget->save();
                $new_container_widget_id = $container_widget->id; 
            }
        }
        return ['id'=>$new_container_widget_id,'message'=>"Widget has been Added successfully!"];
        
    }

}
