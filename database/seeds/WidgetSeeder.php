<?php

use Illuminate\Database\Seeder;
use App\AdminWidget;
use App\AdminContainer;

class WidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $container = new AdminContainer();
        $container->title = "Dashboard";
        $container->name = "dashboard";
        $container->save();

        $container = new AdminContainer();
        $container->title = "Footer";
        $container->name = "footer";
        $container->save();
        // for ($i=0; $i < 3; $i++) { 
        //     $container = new AdminContainer();
        //     $container->title = "Container " . ($i+1);
        //     $container->name = "Container " . ($i+1);
        //     $container->save();   
        // }

        // for ($i=0; $i < 5; $i++) { 
        //     $widget = new AdminWidget();
        //     $widget->title = "Widget " . ($i+1);
        //     $widget->value = "Widget " . ($i+1);
        //     $widget->save();
        // }

        // Start About
            $object = [
                'form' => '<!--begin::Group-->
                    <div class="form-group ">
                        <label for="logo">Footer Logo</label>
                
                        <div class="col" style="margin-bottom: 60px;">
                            <input type="file" name="logo" placeholder="Choose logo..." class="custom-file-input">
                            <label class="custom-file-label" for="logo">Choose logo...</label>
                        </div>
                
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                
                    <div class="form-group ">
                        <label for="description">About description</label>
                
                        <input type="text" name="description" placeholder="About description" value=""
                            class="form-control ">
                
                    </div>
                    <!--end::Group-->',
                'value' => ['logo' => '','description'=>''],
                'view' => '',
            ];

            $widget = new AdminWidget();
            $widget->title = "About";
            $widget->name = "about";
            $widget->value = '';
            $widget->link = '';
            $widget->class = '';
            $widget->type = "about";
            $widget->object = json_encode($object);
            $widget->save();
        // End About

        // Start Contact Info
            $object = [
                'form' => '<!--begin::Group-->
                
                    <div class="form-group ">
                        <label for="address">Contact address</label>
                
                        <input type="text" name="address" placeholder="Contact address" value=""
                            class="form-control ">
                
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                
                    <div class="form-group ">
                        <label for="phone">Contact phone</label>
                
                        <input type="text" name="phone" placeholder="Contact phone" value=""
                            class="form-control ">
                
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                
                    <div class="form-group ">
                        <label for="email">Contact email</label>
                
                        <input type="text" name="email" placeholder="Contact email" value=""
                            class="form-control ">
                
                    </div>
                    <!--end::Group-->',
                'value' => ['address' => '','phone'=>'','email'=>''],
                'view' => '',
            ];

            $widget = new AdminWidget();
            $widget->title = "Contact Info";
            $widget->name = "contact_info";
            $widget->value = '';
            $widget->link = '';
            $widget->class = '';
            $widget->type = "contact_info";
            $widget->object = json_encode($object);
            $widget->save();
        // End Contact Info

        // Start HTML
            $object = [
                'form' => '<!--begin::Group-->
                
                    <div class="form-group ">
                        <label for="html">HTML</label>
                
                        <textarea type="textarea" name="html" placeholder="html ..." rows="6" class="form-control"></textarea>
                
                    </div>
                    <!--end::Group-->',
                'value' => ['html' => ''],
                'view' => '',
            ];

            $widget = new AdminWidget();
            $widget->title = "HTML";
            $widget->name = "html";
            $widget->value = '';
            $widget->link = '';
            $widget->class = '';
            $widget->type = "html";
            $widget->object = json_encode($object);
            $widget->save();
        // End HTML

        // Start Text
            $object = [
                'form' => '<!--begin::Group-->
                    <div class="form-group ">
                        <label for="title">Title</label>
                
                        <input type="text" name="title" placeholder="title" value=""
                            class="form-control ">
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                
                    <div class="form-group ">
                        <label for="description">Description</label>
                
                        <textarea type="textarea" name="description" placeholder="description ..." rows="6" class="form-control"></textarea>
                
                    </div>
                    <!--end::Group-->',
                'value' => ['title' => '','description'=>''],
                'view' => '',
            ];

            $widget = new AdminWidget();
            $widget->title = "Text";
            $widget->name = "text";
            $widget->value = '';
            $widget->link = '';
            $widget->class = '';
            $widget->type = "text";
            $widget->object = json_encode($object);
            $widget->save();
        // End Text
    }
}
