<?php 
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
	//Update Routes
    Route::get('shipments/settings','ShipmentController@settings')->name('admin.shipments.settings');
    Route::post('shipments/settings/store','ShipmentController@storeSettings')->name('admin.shipments.settings.store');

    Route::get('shipments/settings/fees','ShipmentController@feesSettings')->name('admin.shipments.settings.fees');
    Route::get('shipments/settings/fees-fixed','ShipmentController@feesFixedSettings')->name('admin.shipments.settings.fees.fixed');
    Route::get('shipments/settings/fees-gram','ShipmentController@feesGramSettings')->name('admin.shipments.settings.fees.gram');
    Route::get('shipments/settings/fees-state-to-state','ShipmentController@feesStateToStateSettings')->name('admin.shipments.settings.fees.state-to-state');
    Route::get('shipments/settings/fees-country-to-country','ShipmentController@feesCountryToCountrySettings')->name('admin.shipments.settings.fees.country-to-country');
    Route::get('shipments/ajaxed-get-states','ShipmentController@ajaxGetStates')->name('admin.shipments.get-states-ajax');
    Route::get('shipments/ajaxed-get-areas','ShipmentController@ajaxGetAreas')->name('admin.shipments.get-areas-ajax');
    Route::post('shipments/action/{to}','ShipmentController@change')->name('admin.shipments.action');
    Route::post('shipments/action/pickup_mission/{type}','ShipmentController@createPickupMission')->name('admin.shipments.action.create.pickup.mission');
    Route::post('shipments/action/supply_mission/{type}','ShipmentController@createSupplyMission')->name('admin.shipments.action.create.supply.mission');
    Route::post('shipments/action/delivery_mission/{type}','ShipmentController@createDeliveryMission')->name('admin.shipments.action.create.delivery.mission');
    Route::post('shipments/action/return_mission/{type}','ShipmentController@createReturnMission')->name('admin.shipments.action.create.return.mission');
    
    
    Route::get('shipments/remove-shipment-from-mission/{shipment}/{mission}','ShipmentController@removeShipmentFromMission')->name('admin.shipments.delete-shipment-from-mission');
    Route::resource('shipments','ShipmentController',[
        'as' => 'admin'
    ]);
    Route::resource('costs','CostController',[
        'as' => 'admin'
    ]);
    Route::resource('areas','AreaController',[
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

    Route::get('areas/delete/{area}','AreaController@destroy')->name('admin.areas.delete-area');
    

});