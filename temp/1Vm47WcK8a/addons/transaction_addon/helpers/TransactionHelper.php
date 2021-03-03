<?php

namespace App\Http\Helpers;

use App\Transaction;
use App\Mission;
use App\Shipment;
use App\ShipmentLog;
use App\ShipmentMission;
use App\Client;
use DB;
class TransactionHelper{

    private function pickup_mission_prepaid_shipments_ids($mission_id)
    {
        $m_shipments = ShipmentMission::where('mission_id',$mission_id)->pluck('shipment_id');
        $shipments = Shipment::whereIn('id',$m_shipments)->where('payment_type',Shipment::PREPAID)->pluck('id');
        return $shipments;
    }

    private function pickup_mission_prepaid_shipments_cost_calculator($shipment_ids)
    {
        $cost = 0;
        foreach($shipment_ids as $id)
        {
            $cost+= (double) $this->calculate_shipment_cost($id);
        }
        return $cost;
    }

    private function delivery_mission_postpaid_shipments_ids($mission_id)
    {
        $m_shipments = ShipmentMission::where('mission_id',$mission_id)->pluck('shipment_id');
        $shipments = Shipment::whereIn('id',$m_shipments)->where('payment_type',Shipment::POSTPAID)->pluck('id');
        return $shipments;
    }

    private function delivery_mission_postpaid_shipments_cost_calculator($shipment_ids)
    {
        $cost = 0;
        foreach($shipment_ids as $id)
        {
            $cost+= (double) $this->calculate_shipment_cost($id);
        }
        return $cost;
    }

    private function return_mission_shipments_ids($mission_id)
    {
        $m_shipments = ShipmentMission::where('mission_id',$mission_id)->pluck('shipment_id');
        $shipments = Shipment::whereIn('id',$m_shipments)->pluck('id');
        return $shipments;
    }

    private function return_mission_return_cost_calculator($shipment_ids)
    {
        $cost = 0;
        foreach($shipment_ids as $id)
        {
            $cost+= (double) $this->calculate_shipment_cost($id);
        }
        return $cost;
    }

    public function calcMissionShipmentsAmount($type,$mission_id)
    {
        $shipments_cost = 0;
        if($type == Mission::PICKUP_TYPE)
        {
            $ids= $this->pickup_mission_prepaid_shipments_ids($mission_id);
            $shipments_cost += (double) $this->pickup_mission_prepaid_shipments_cost_calculator($ids);
          
        }elseif($type == Mission::DELIVERY_TYPE)
        {
            $ids= $this->delivery_mission_postpaid_shipments_ids($mission_id);
            $shipments_cost += (double) $this->delivery_mission_postpaid_shipments_cost_calculator($ids);
        }elseif($type == Mission::RETURN_TYPE)
        {
            $ids= $this->return_mission_shipments_ids($mission_id);
            $shipments_cost += (double) $this->return_mission_return_cost_calculator($ids);
        }
        return $shipments_cost;
    }

    public function getPickupCost($mession_id)
    {
        $mission = Mission::find($mession_id);
        $pickup = (double) $mission->amount-$this->calcMissionShipmentsAmount(Mission::PICKUP_TYPE,$mission->id);
        return $pickup;
    }

    public function calculate_mission_amount($mission_id)
    {
        $amount = 0;
        $mission = Mission::find($mission_id);
        if($mission->getOriginal('type') == Mission::PICKUP_TYPE)
        {
            $client = Client::find($mission->client_id);
            $amount += $client->pickup_cost;
            $amount += $this->calcMissionShipmentsAmount($mission->getOriginal('type'),$mission->id);
        }elseif($mission->getOriginal('type') == Mission::DELIVERY_TYPE)
        {
            $amount += $this->calcMissionShipmentsAmount($mission->getOriginal('type'),$mission->id);
        }elseif($mission->getOriginal('type') == Mission::RETURN_TYPE)
        {
            $amount += $this->calcMissionShipmentsAmount($mission->getOriginal('type'),$mission->id);
        }
        
        $mission->amount = $amount;
        $mission->save();
    }

    public function calculate_shipment_cost($shipment_id)
    {
		$cost = 0;
        
        $shipment = Shipment::where('id',$shipment_id)->first();
        if(in_array($shipment->status_id,[Shipment::RETURNED_CLIENT_GIVEN,Shipment::RETURNED_STATUS,Shipment::RETURNED_STOCK]))
        {
                $cost += $shipment->return_cost;
        }else
        {
            $cost += $shipment->shipping_cost + $shipment->tax + $shipment->insurance;
        }
        
        return $cost;
    }

    public function create_mission_transaction($mission_id,$value,$transaction_owner,$transaction_owner_id,$operation)
    {
        
		try {
			DB::beginTransaction();

            if($operation == Transaction::DEBIT)
            {
                $value = -$value;
            }elseif($operation == Transaction::CREDIT)
            {
                $value = $value;
            }
            
            
            $transaction = new Transaction();
            $transaction->type = \App\Transaction::MESSION_TYPE;
            $transaction->transaction_owner = $transaction_owner;
            if($transaction_owner == Transaction::CAPTAIN)
            {
                $transaction->captain_id = $transaction_owner_id;
            }elseif($transaction_owner == Transaction::CLIENT)
            {
                $transaction->client_id = $transaction_owner_id;
            }elseif($transaction_owner == Transaction::BRANCH)
            {
                $transaction->branch_id = $transaction_owner_id;
            }
            $transaction->value = $value;
            $transaction->mission_id = $mission_id;
            $transaction->save();

            DB::commit();
        }catch (\Exception $e) {
			echo $e->getMessage();exit;
           
			DB::rollback();

			
		}
     
    }

    public function create_shipment_transaction($shipment_id,$value,$transaction_owner,$transaction_owner_id,$operation)
    {
        
		try {
			DB::beginTransaction();
            if($operation == Transaction::DEBIT)
            {
                $value = -$value;
            }elseif($operation == Transaction::CREDIT)
            {
                $value = $value;
            }
            
            
            $transaction = new Transaction();
            $transaction->type = \App\Transaction::SHIPMENT_TYPE;
            $transaction->transaction_owner = $transaction_owner;
            if($transaction_owner == Transaction::CAPTAIN)
            {
                $transaction->captain_id = $transaction_owner_id;
            }elseif($transaction_owner == Transaction::CLIENT)
            {
                $transaction->client_id = $transaction_owner_id;
            }elseif($transaction_owner == Transaction::BRANCH)
            {
                $transaction->branch_id = $transaction_owner_id;
            }
            $transaction->value = $value;
            $transaction->shipment_id = $shipment_id;
            $transaction->save();

            DB::commit();
        }catch (\Exception $e) {
			//echo $e->getMessage();exit;
			DB::rollback();
			
		}
     
    }
}

