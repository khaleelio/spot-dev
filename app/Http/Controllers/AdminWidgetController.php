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

    public function update_container_widget(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:admin_container_widgets,id',
            'title' => 'nullable|max:255',
            'name' => 'nullable|max:255',
            'value' => 'nullable|max:294967295',
            'link' => 'nullable|max:255',
            'class' => 'nullable|max:255',
            'type' => 'nullable|max:255',
            'object' => 'nullable|max:294967295',
        ]);
        $widget = AdminContainerWidget::find($request->id);
        if($widget->type){
            $object = json_decode($widget->object);
            $new_value;
            foreach ($object->value as $key => $value) {
                if($request->hasFile($key)){
                    $validated = $request->validate([
                        $key => 'mimes:jpeg,png|max:5120',
                    ]);

                    $extension = $request[$key]->extension();
                    $img_name = time();
                    $request[$key]->storeAs('/widget', $img_name.".".$extension);
                    $url = 'widget/'.$img_name.".".$extension;
                    $new_value[$key] = $url;
                    // return "jytrerftghjk";
                    if (\Storage::exists($value)) {
                        \Storage::delete($value);
                    }

                }else{
                    $new_value[$key] = $request[$key] ?? $value;
                }
            }
            // return $this->get_style($new_value , $widget->type);
            $new_object = [
                'form' => $this->get_style($new_value , $widget->type),
                'value' => $new_value,
                'view' => '',
            ];
            // return $new_object;
            $widget->object = json_encode($new_object);
            $widget->save();
        }else{
            $widget->title = $request->title;
            $widget->value = $request->value;
            $widget->link = $request->link;
            $widget->class = $request->class;
            $widget->save();
        }

        flash(translate('New widget has been updated successfully'))->success();
        return redirect()->route('website.container.index');
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

    public function destroy_container_widget($id)
    {
        $container_widget = AdminContainerWidget::findOrFail($id);
        if($container_widget->object){
            $object = json_decode($container_widget->object);
            if(isset( $object->value->logo )){
                if (\Storage::exists($object->value->logo)) {
                    \Storage::delete($object->value->logo);
                }
            }
        }
        $container_widget->delete();
        flash(translate('Widget has been deleted successfully'))->success();
        return redirect()->back();
    }

    public function get_style($value , $type)
    {
        if($type == "about"){
            return $this->about_style($value);
        }elseif($type == "contact_info"){
            return $this->contact_info_style($value);
        }elseif($type == "html"){
            return $this->html_style($value);
        }elseif($type == "text"){
            return $this->text_style($value);
        }else{

        }
    }

    public function about_style($value)
    {
        $style = '<!--begin::Group-->
            <div class="form-group ">
                <div class="row mb-3">
                    <div class="col-6 pt-3"><label for="logo" class="">Footer Logo</label></div>
                    <div class="col-6"><img src="'.static_asset($value['logo'] ?? '').'" class="" style="max-height: 45px;float: right;"/></div>
                </div>
                <div class="col" style="margin-bottom: 60px;">
                    <input type="file" name="logo" placeholder="Choose logo..." class="custom-file-input">
                    <label class="custom-file-label" for="logo">Choose logo...</label>
                </div>
        
            </div>
            <!--end::Group-->
            <!--begin::Group-->
        
            <div class="form-group ">
                <label for="description">About description</label>
        
                <input type="text" name="description" placeholder="About description" value="'.($value['description']  ?? '').'"
                    class="form-control " >
        
            </div>
            <!--end::Group-->
            <!--begin::Group-->';

            return $style;
    }

    public function contact_info_style($value)
    {
        $style = '<!--begin::Group-->
                
            <div class="form-group ">
                <label for="address">Contact address</label>
        
                <input type="text" name="address" placeholder="Contact address" value="'.($value['address']  ?? '').'"
                    class="form-control ">
        
            </div>
            <!--end::Group-->
            <!--begin::Group-->
        
            <div class="form-group ">
                <label for="phone">Contact phone</label>
        
                <input type="text" name="phone" placeholder="Contact phone" value="'.($value['phone']  ?? '').'"
                    class="form-control ">
        
            </div>
            <!--end::Group-->
            <!--begin::Group-->
        
            <div class="form-group ">
                <label for="email">Contact email</label>
        
                <input type="text" name="email" placeholder="Contact email" value="'.($value['email']  ?? '').'"
                    class="form-control ">
        
            </div>
            <!--end::Group-->';

            return $style;
    }
    
    public function html_style($value)
    {
        $style = '<!--begin::Group-->
                
        <div class="form-group ">
            <label for="html">HTML</label>
    
            <textarea type="textarea" name="html" placeholder="html ..." rows="6" class="form-control">'.($value['html']  ?? '').'</textarea>
    
        </div>
        <!--end::Group-->';

        return $style;
    }

    public function text_style($value)
    {
        $style = '<!--begin::Group-->
        <div class="form-group ">
            <label for="title">Title</label>
    
            <input type="text" name="title" placeholder="title" value="'.($value['title']  ?? '').'"
                class="form-control ">
        </div>
        <!--end::Group-->
        <!--begin::Group-->
        <div class="form-group ">
            <label for="description">Description</label>
    
            <textarea type="textarea" name="description" placeholder="description ..." rows="6" class="form-control">'.($value['description']  ?? '').'</textarea>
    
        </div>
        <!--end::Group-->';

        return $style;
    }
}
