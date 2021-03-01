<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded = [];

    //Shipment Types 
     CONST PICKUP = 1;
     CONST DROPOFF = 2;

     //Payment Methods 
     CONST CASH_METHOD = 1;
     CONST PAYPAL_METHOD = 2;

     //Shipments Status Manager 
     CONST SAVED_STATUS = 1;
     CONST REQUESTED_STATUS = 2;
     CONST APPROVED_STATUS = 3;
     CONST CLOSED_STATUS = 4;
     CONST CAPTAIN_ASSIGNED_STATUS = 5;
     CONST RECIVED_STATUS = 6;
     CONST IN_STOCK_STATUS = 7;
     CONST PENDING_STATUS = 8;
     CONST DELIVERED_STATUS = 9;
     CONST SUPPLIED_STATUS = 10;
     CONST RETURNED_STATUS = 11;
     CONST RETURNED_ON_SENDER = 12;
     CONST RETURNED_ON_RECEIVER = 13;
     CONST RETURNED_STOCK = 14;
     CONST RETURNED_CLIENT_GIVEN = 15;
     

     static public function status_info()
     {
        $array = [
            ['status' => Self::SAVED_STATUS,
             'text' => translate('Saved'),
             'route_name' => 'admin.shipments.saved.index',
             'route_url'=>'saved',
             'optional_params'=>'/{type?}'],

            ['status' => Self::REQUESTED_STATUS,
             'text' => translate('Requested'),
             'route_name' => 'admin.shipments.requested.index',
             'route_url'=>'requested',
             'optional_params'=>'/{type?}'],

            ['status' => Self::APPROVED_STATUS,
             'text' => translate('Approved'),
             'route_name' => 'admin.shipments.approved.index',
             'route_url'=>'approved'],

            ['status' => Self::CLOSED_STATUS,
             'text' => translate('Closed'),
             'route_name' => 'admin.shipments.closed.index',
             'route_url'=>'closed'],

            ['status' => Self::CAPTAIN_ASSIGNED_STATUS,
             'text' => translate('Assigned'),
             'route_name' => 'admin.shipments.assigned.index',
             'route_url'=>'assigned'],

            ['status' => Self::RECIVED_STATUS,
             'text' => translate('Received'),
             'route_name' => 'admin.shipments.captain.given.index',
             'route_url'=>'deliverd-to-driver'],

        

            ['status' => Self::DELIVERED_STATUS,
             'text' => translate('Deliverd'),
             'route_name' => 'admin.shipments.delivred.index',
             'route_url'=>'delivred'],

            ['status' => Self::SUPPLIED_STATUS,
             'text' => translate('Supplied'),
             'route_name' => 'admin.shipments.supplied.index',
             'route_url'=>'supplied'],
             
             ['status' => Self::IN_STOCK_STATUS,
             'text' => translate('In Stock'),
             'route_name' => 'admin.shipments.instock.index',
             'route_url'=>'in-stock'],

            ['status' => Self::PENDING_STATUS,
             'text' => translate('Pending'),
             'route_name' => 'admin.shipments.pending.index',
             'route_url'=>'pending'],

            ['status' => Self::RETURNED_STATUS,
             'text' => translate('Returned'),
             'route_name' => 'admin.shipments.returned.sender.index',
             'route_url'=>'returned-on-sender'],

            ['status' => Self::RETURNED_STOCK,
             'text' => translate('Returned Stock'),
             'route_name' => 'admin.shipments.returned.stock.index',
             'route_url'=>'returned-stock'],

            ['status' => Self::RETURNED_STOCK,
             'text' => translate('Returned & Deliverd'),
             'route_name' => 'admin.shipments.returned.deliverd.index',
             'route_url'=>'returned-deliverd'],
             
             

        ];
        return $array;
     }
     public function getStatus()
     {
        $result = null;
        foreach(Self::status_info() as $status)
        {
            $status_id = $this->status_id;
            $result = (isset($status['status']) && $status['status'] == $status_id) ?$status['text']: null;
            if($result != null){
                return $result;
            }
        }
        
        return $result;
     }
     static public function getStatusByStatusId($status_id_attr)
     {
        $result = null;
        foreach(Self::status_info() as $status)
        {
            $status_id = $status_id_attr;
            $result = (isset($status['status']) && $status['status'] == $status_id) ?$status['text']: null;
            if($result != null){
                return $result;
            }
        }
        
        return $result;
     }

     static public function getStatusByRoute($route_name)
     {
        $result = null;
        foreach(Self::status_info() as $status)
        {
            $result = (isset($status['route_name']) && $status['route_name'] == $route_name) ?$status['status']: null;
            return $result;
        }
        return $result;
     }

     public function getTypeAttribute($value)
     {
         if($value == Self::DROPOFF)
         {
             return translate('Dropoff');
         }elseif($value == Self::PICKUP)
         {
            return translate('Pickup');
         }
     }

     static public function getType($value)
     {
         if($value == Self::DROPOFF)
         {
             return translate('Dropoff');
         }elseif($value == Self::PICKUP)
         {
            return translate('Pickup');
         }else
         {
             return null;
         }
     }

     public function getPaymentMethodAttribute($value)
     {
        if($value == Self::CASH_METHOD)
        {
             return translate('Cash');
        }elseif($value == Self::PAYPAL_METHOD)
        {
            return translate('Paypal');
        }
     }
    public function client()
    {
        return $this->hasOne('App\Client', 'id', 'client_id');
    }

    public function captain()
    {
        return $this->hasOne('App\Captain', 'id', 'captain_id');
    }

    public function current_mission()
    {
        return $this->hasOne('App\Mission', 'id', 'mission_id');
    }

    public function branch()
    {
        return $this->hasOne('App\Branch', 'id', 'branch_id');
    }
}
