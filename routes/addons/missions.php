<?php 
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::post('missions/action/{to}','MissionsController@change')->name('admin.missions.action');
    Route::post('missions/action/approve/{to}','MissionsController@approveAndAssign')->name('admin.mission.action.approve');
    Route::get('missions/action/confirm_amount/{mission_id}','MissionsController@getAmountModel')->name('admin.missions.action.confirm_amount');
    Route::resource('missions','MissionsController',[
        'as' => 'admin'
    ]);
    foreach(\App\Mission::status_info() as $item)
    {
        $params ='';
        if(isset($item['optional_params']))
        {
            $params = $item['optional_params'];
        }
        Route::get('missions/'.$item['route_url'].'/{status}'.$params,'MissionsController@statusIndex')
        ->name($item['route_name']);
    }

    

});