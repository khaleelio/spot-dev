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
        $container->name = "Dashboard";
        $container->save();
        // for ($i=0; $i < 3; $i++) { 
        //     $container = new AdminContainer();
        //     $container->title = "Container " . ($i+1);
        //     $container->name = "Container " . ($i+1);
        //     $container->save();   
        // }

        // for ($i=0; $i < 10; $i++) { 
        //     $widget = new AdminWidget();
        //     $widget->title = "Widget " . ($i+1);
        //     $widget->value = "Widget " . ($i+1);
        //     $widget->save();
        // }
    }
}
