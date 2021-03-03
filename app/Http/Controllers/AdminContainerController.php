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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'title' => 'nullable|max:255',
        ]);
        $container = new AdminContainer();
        $container->title = $request->title;
        $container->name = $request->name;
        $container->save();

        flash(translate('New container has been created successfully'))->success();
        return redirect()->route('website.container.index');
    }

    public function destroy($id)
    {
        $container = AdminContainer::findOrFail($id);
        if(count($container->container_widget) == 0){
            $container->delete();
        }else{
            flash(translate("You can't delete this container , you have to delete or move all widgets first"))->error();
            return redirect()->back();
        }
        flash(translate('Container has been deleted successfully'))->success();
        return redirect()->back();
    }
}
