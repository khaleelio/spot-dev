<?php 
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
	//Update Routes
    Route::get('shipments/settings','ShipmentController@settings')->name('admin.shipments.settings');
    Route::post('shipments/settings/store','ShipmentController@storeSettings')->name('admin.shipments.settings.store');
    Route::post('shipments/action/{to}','ShipmentController@change')->name('admin.shipments.action');
    Route::post('shipments/action/pickup_mission/{type}','ShipmentController@createPickupMission')->name('admin.shipments.action.create.pickup.mission');
    Route::post('shipments/action/delivery_mission/{type}','ShipmentController@createDeliveryMission')->name('admin.shipments.action.create.delivery.mission');

    
    Route::get('shipments/remove-shipment-from-mission/{shipment}/{mission}','ShipmentController@removeShipmentFromMission')->name('admin.shipments.delete-shipment-from-mission');
    Route::resource('shipments','ShipmentController',[
        'as' => 'admin'
    ]);
    Route::get('shipments/delete/{shipment}','ShipmentController@destroy')->name('admin.shipments.delete-shipment');
    Route::patch('shipments/update/{shipment}','ShipmentController@update')->name('admin.shipments.update-shipment');

    //Auto Route Creation Based on Statuses Function in Shipment Model
    foreach(\App\Shipment::status_info() as $item)
    {
        $params ='';
        if(isset($item['optional_params']))
        {
            $params = $item['optional_params'];
        }
        Route::get('shipments/'.$item['route_url'].'/{status}'.$params,'ShipmentController@statusIndex')
        ->name($item['route_name']);
    }

    
    
    Route::resource('packages','PackagesController',[
        'as' => 'admin'
    ]);
    Route::get('packages/delete/{package}','PackagesController@destroy')->name('admin.packages.delete-package');


    

});