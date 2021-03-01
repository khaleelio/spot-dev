<?php

namespace App\Http\Helpers;

use App\Mission;
use DB;
class MissionStatusManagerHelper{


    //Mission Status Manager

    public function change_mission_status($missions,$to,$captain_id=null)
    {
        $response = array();
		$response['success'] = 1;
		$response['error_msg'] = '';
		try {
			DB::beginTransaction();
            foreach($missions as $mission_id)
            {
                $mission = Mission::find($mission_id);
                if($mission !=null)
                {
                    $oldStatus = $mission->status_id;
                    if($to == Mission::APPROVED_STATUS)
                    {
                        if($captain_id !=null)
                        {
                            $mission->captain_id = $captain_id;
                        }else
                        {
                            throw new \Exception("Captain is required in this step");
                        }
                    }

                    if($to == Mission::RECIVED_STATUS)
                    {
                        if($mission->type == Mission::getType(Mission::DELIVERY_TYPE))
                        {
                            if(\Schema::hasTable('shipment_mission') && class_exists("\App\ShipmentMission") && class_exists("\App\Shipment") && class_exists("\App\Http\Helpers\StatusManagerHelper"))
                            {
                                 foreach(\App\ShipmentMission::where('mission_id',$mission->id)->pluck('shipment_id') as $shipment_id)
                                 {
                                     $shipment = \App\Shipment::find($shipment_id);
                                     $change_status_to_be_approved = new \App\Http\Helpers\StatusManagerHelper();
                                     $change_status_to_be_approved->change_shipment_status([$shipment->id],\App\Shipment::RECIVED_STATUS);
                                 }
                            }
                        }
                    }

                    if($to == Mission::RECIVED_STATUS)
                    {

                    }

                    if($to == Mission::DONE_STATUS)
                    {
                        if($mission->type == Mission::getType(Mission::PICKUP_TYPE))
                        {
                           //Hook shipment backend in Mission status changed
                           if(\Schema::hasTable('shipment_mission') && class_exists("\App\ShipmentMission") && class_exists("\App\Shipment") && class_exists("\App\Http\Helpers\StatusManagerHelper"))
                           {
                                foreach(\App\ShipmentMission::where('mission_id',$mission->id)->pluck('shipment_id') as $shipment_id)
                                {
                                    $shipment = \App\Shipment::find($shipment_id);
                                    $change_status_to_be_approved = new \App\Http\Helpers\StatusManagerHelper();
                                    $change_status_to_be_approved->change_shipment_status([$shipment->id],\App\Shipment::APPROVED_STATUS);
                                }
                           }
                        }

                        if($mission->type == Mission::getType(Mission::DELIVERY_TYPE))
                        {
                            foreach(\App\ShipmentMission::where('mission_id',$mission->id)->pluck('shipment_id') as $shipment_id)
                            {
                                $shipment = \App\Shipment::find($shipment_id);
                                $change_status_to_be_approved = new \App\Http\Helpers\StatusManagerHelper();
                                $change_status_to_be_approved->change_shipment_status([$shipment->id],\App\Shipment::DELIVERED_STATUS);
                            }
                        }
                    }
                    
                    $mission->status_id = $to;
                    if(!$mission->save())
                    {
                        throw new \Exception("can't change mission status");
                    }
                    //After change action 
                    if($to == Mission::APPROVED_STATUS)
                    {
                     
                        if($mission->type == Mission::getType(Mission::DELIVERY_TYPE))
                        {
                            
                            //Hook shipment backend in Mission status changed
                            if(\Schema::hasTable('shipment_mission') && class_exists("\App\ShipmentMission") && class_exists("\App\Shipment") && class_exists("\App\Http\Helpers\StatusManagerHelper"))
                            {
                              
                                foreach(\App\ShipmentMission::where('mission_id',$mission->id)->pluck('shipment_id') as $shipment_id)
                                {
                                    $shipment = \App\Shipment::find($shipment_id);
                                    $change_status_to_be_approved = new \App\Http\Helpers\StatusManagerHelper();
                                    $change_status_to_be_approved->change_shipment_status([$shipment->id],\App\Shipment::CAPTAIN_ASSIGNED_STATUS,$mission->id);
                                }
                            }
                        }
                    }
                   
                }else
                {
                    throw new \Exception("There is no mission with this Code");
                }
                
            }
            DB::commit();
        }catch (\Exception $e) {
			//echo $e->getMessage();exit;
			DB::rollback();
			$response['success'] = 0;
			$response['error_msg'] = $e->getMessage();
		}
        return $response;
    }

}