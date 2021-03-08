<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminContainer;
use App\AdminContainerWidget;
use App\AdminWidget;

class AdminContainerController extends Controller
{
    public function index()
    {
        $containers = AdminContainer::all();
        // return $containers[0]->container_widget[0];
        $widgets = AdminWidget::all();
        return view('backend.widget.index',['containers'=>$containers,'widgets'=>$widgets]);
    }

    public function store($request)
    {
        $container = new AdminContainer();
        $container->title = $request['title'];
        $container->name = $request['name'];
        $container->active = $request['active'] ?? 1;
        $container->save();

        return $container;
    }

    public function update($request)
    {
        $container = AdminContainer::find($request['id']);
        if($container){
            $container->title = $request['title'] ?? $container->title;
            $container->name = $request['name'] ?? $container->name;
            $container->active = $request['active'] ?? $container->active;
            $container->save();

            return $container;
        }else{
            return translate('Invalid ID');
        }
    }

    public function destroy($id)
    {
        $container = AdminContainer::find($id);
        if($container){
            if(count($container->container_widget) == 0){
                $container->delete();
                return translate('Container has been deleted successfully');
            }else{
                return translate("You can't delete this container , you have to delete or move all widgets first");
            }
        }else{
            return translate('Invalid ID');
        }
    }

    public function get_by_name($name)
    {
        $container = AdminContainer::where('name',$name)->get();
        return $container;
    }
}
