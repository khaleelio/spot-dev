<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ShipmentActionHelper;
use App\Http\Helpers\StatusManagerHelper;
use App\Http\Helpers\TransactionHelper;
use App\Mission;
use App\PackageShipment;
use App\Shipment;
use App\ShipmentMission;
use App\ShipmentSetting;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments = Shipment::paginate(20);
        $actions = new ShipmentActionHelper();
        $actions = $actions->get('all');
        $page_name = translate('All Shipments');
        $status = 'all';
        return view('backend.shipments.index',compact('shipments','page_name','actions','status'));
    }


    public function statusIndex($status,$type=null)
    {
        $shipments = Shipment::where('status_id',$status);
        if($type !=null)
        {
            $shipments = $shipments->where('type',$type);
        }
        $shipments = $shipments->paginate(20);
        
        $actions = new ShipmentActionHelper();
        $actions = $actions->get($status,$type);
        $page_name = Shipment::getStatusByStatusId($status)." ".Shipment::getType($type);
        
        return view('backend.shipments.index',compact('shipments','actions','page_name','type','status'));
    }

    public function createPickupMission(Request $request,$type)
    {
        try{	
			DB::beginTransaction();
			$model = new Mission();
			$model->fill($request['Mission']);
			$model->code = -1;
            $model->status_id = Mission::REQUESTED_STATUS;
            $model->type = Mission::PICKUP_TYPE;
			if (!$model->save()){
				throw new \Exception();
			}
			$model->code = $model->id;
			if (!$model->save()){
				throw new \Exception();
			}
            //change shipment status to requested
            $action = new StatusManagerHelper();
            $response = $action->change_shipment_status($request->checked_ids,Shipment::REQUESTED_STATUS,$model->id);

            //Calaculate Amount 
            $helper = new TransactionHelper();
            $helper->calculate_mission_amount($model->id);
            
            DB::commit();
            flash(translate("Mission created successfully"))->success();
            return back();
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
		}
        
    }

    public function createDeliveryMission(Request $request,$type)
    {
        try{	
			DB::beginTransaction();
			$model = new Mission();
			$model->fill($request['Mission']);
			$model->code = -1;
            $model->status_id = Mission::REQUESTED_STATUS;
            $model->type = Mission::DELIVERY_TYPE;
			if (!$model->save()){
				throw new \Exception();
			}
			$model->code = $model->id;
			if (!$model->save()){
				throw new \Exception();
			}
            foreach($request->checked_ids as $shipment_id)
            {
                if($model->id != null && ShipmentMission::check_if_shipment_is_assigned_to_mission($shipment_id,Mission::DELIVERY_TYPE) == 0)
                {
                        $shipment = Shipment::find($shipment_id);
                        $shipment_mission = new ShipmentMission();
                        $shipment_mission->shipment_id = $shipment->id;
                        $shipment_mission->mission_id = $model->id;
                        if($shipment_mission->save())
                        {
                            $shipment->mission_id = $model->id;
                            $shipment->save();
                        }
                }
            }

            //Calaculate Amount 
            $helper = new TransactionHelper();
            $helper->calculate_mission_amount($model->id);


            DB::commit();
            flash(translate("Mission created successfully"))->success();
            return back();
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
		}
        
    }

    public function createReturnMission(Request $request,$type)
    {
        try{	
			DB::beginTransaction();
			$model = new Mission();
			$model->fill($request['Mission']);
			$model->code = -1;
            $model->status_id = Mission::REQUESTED_STATUS;
            $model->type = Mission::RETURN_TYPE;
			if (!$model->save()){
				throw new \Exception();
			}
			$model->code = $model->id;
			if (!$model->save()){
				throw new \Exception();
			}
            foreach($request->checked_ids as $shipment_id)
            {
                if($model->id != null && ShipmentMission::check_if_shipment_is_assigned_to_mission($shipment_id,Mission::RETURN_TYPE) == 0)
                {
                        $shipment = Shipment::find($shipment_id);
                        $shipment_mission = new ShipmentMission();
                        $shipment_mission->shipment_id = $shipment->id;
                        $shipment_mission->mission_id = $model->id;
                        if($shipment_mission->save())
                        {
                            $shipment->mission_id = $model->id;
                            $shipment->save();
                        }
                }
            }

            //Calaculate Amount 
            $helper = new TransactionHelper();
            $helper->calculate_mission_amount($model->id);

            DB::commit();
            flash(translate("Mission created successfully"))->success();
            return back();
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
		}
        
    }

    public function removeShipmentFromMission($shipment,$mission)
    {
        try{	
			DB::beginTransaction();
			
            //change shipment status to requested
            $action = new StatusManagerHelper();
            $response = $action->change_shipment_status([$shipment],Shipment::SAVED_STATUS,$mission);

            //Calaculate Amount 
            $helper = new TransactionHelper();
            $helper->calculate_mission_amount($mission);
            
            DB::commit();
            flash(translate("Shipment removed from mission successfully"))->success();
            return back();
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
		}
    }
    public function change(Request $request,$to)
    {
        
        if(isset($request->checked_ids))
        {
            $action = new StatusManagerHelper();
            $response = $action->change_shipment_status($request->checked_ids,$to);
            if($response['success'])
            {
                flash(translate("Status Changed Successfully!"))->success();
                return back();
            }
            
        }else
        {
            flash(translate("Please select shipments"))->error();
            return back();
        }
        
    }

  

    public function settings()
    {

        return view('backend.shipments.settings');
    }

    public function storeSettings()
    {
        foreach($_POST['Setting'] as $key=>$value)
        {
            if(ShipmentSetting::getVal($key) == null)
            {
                $set = new ShipmentSetting();
                $set->key = $key;
                $set->value = $value;
                $set->save();
            }else{
                $set = ShipmentSetting::where('key',$key)->first();
                $set->value = $value;
                $set->save();
            }
        }
        flash(translate("Settings Changed Successfully!"))->success();
              return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branchs = Branch::where('is_archived',0)->get();
        $clients = Client::where('is_archived',0)->get();
        return view('backend.shipments.create',compact('branchs','clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{	
			DB::beginTransaction();
			$model = new Shipment();
			
			
			$model->fill($_POST['Shipment']);
			$model->code = -1;
            $model->status_id = Shipment::SAVED_STATUS;
           
			if (!$model->save()){
				throw new \Exception();
			}
			$model->code = $model->id;
			if (!$model->save()){
				throw new \Exception();
			}
            $counter = 0;
            if(isset($_POST['Package']))
            {
                
                if(!empty($_POST['Package']))
                {
                  
                    if(isset($_POST['Package'][$counter]['package_id']))
                    {
                        
                        foreach($_POST['Package'] as $package)
                        {
                            $package_shipment = new PackageShipment();
                            $package_shipment->fill($package);
                            $package_shipment->shipment_id = $model->id;
                            if (!$package_shipment->save()){
                                throw new \Exception();
                            }
                        }
                    }
                }
            }
          
			DB::commit();
            flash(translate("Shipment added successfully"))->success();
            return back();
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shipment = Shipment::find($id);
        return view('backend.shipments.show',compact('shipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branchs = Branch::where('is_archived',0)->get();
        $clients = Client::where('is_archived',0)->get();
        $shipment = Shipment::find($id);
        return view('backend.shipments.edit',compact('branchs','clients','shipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $shipment)
    {
        try{	
			DB::beginTransaction();
			$model = Shipment::find($shipment);
			
			
			$model->fill($_POST['Shipment']);

           
			if (!$model->save()){
				throw new \Exception();
			}
            foreach(\App\PackageShipment::where('shipment_id',$model->id)->get() as $pack){
                $pack->delete();
            }
            $counter = 0;
            if(isset($_POST['Package']))
            {
                
                if(!empty($_POST['Package']))
                {
                  
                    if(isset($_POST['Package'][$counter]['package_id']))
                    {
                        
                        foreach($_POST['Package'] as $package)
                        {
                            $package_shipment = new PackageShipment();
                            $package_shipment->fill($package);
                            $package_shipment->shipment_id = $model->id;
                            if (!$package_shipment->save()){
                                throw new \Exception();
                            }
                        }
                    }
                }
            }
          
			DB::commit();
            flash(translate("Shipment added successfully"))->success();
            return back();
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
