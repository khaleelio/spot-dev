<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded = [];

    //Shipment Types 
    const PICKUP = 1;
    const DROPOFF = 2;

    //Payment Methods 
    const CASH_METHOD = 1;
    const PAYPAL_METHOD = 2;

    //Payment Types 
    const POSTPAID = 1;
    const PREPAID = 2;

    //Shipments Status Manager 
    const SAVED_STATUS = 1;
    const REQUESTED_STATUS = 2;
    const APPROVED_STATUS = 3;
    const CLOSED_STATUS = 4;
    const CAPTAIN_ASSIGNED_STATUS = 5;
    const RECIVED_STATUS = 6;
    const IN_STOCK_STATUS = 7;
    const PENDING_STATUS = 8;
    const DELIVERED_STATUS = 9;
    const SUPPLIED_STATUS = 10;
    const RETURNED_STATUS = 11;
    const RETURNED_ON_SENDER = 12;
    const RETURNED_ON_RECEIVER = 13;
    const RETURNED_STOCK = 14;
    const RETURNED_CLIENT_GIVEN = 15;


    static public function status_info()
    {
        $array = [
            [
                'status' => Self::SAVED_STATUS,
                'text' => translate('Saved'),
                'route_name' => 'admin.shipments.saved.index',
                'permissions' => 1014,
                'route_url' => 'saved',
                'optional_params' => '/{type?}'
            ],

            [
                'status' => Self::REQUESTED_STATUS,
                'text' => translate('Requested'),
                'route_name' => 'admin.shipments.requested.index',
                'permissions' => 1015,
                'route_url' => 'requested',
                'optional_params' => '/{type?}'
            ],

            [
                'status' => Self::APPROVED_STATUS,
                'text' => translate('Approved'),
                'route_name' => 'admin.shipments.approved.index',
                'permissions' => 1016,
                'route_url' => 'approved'
            ],

            [
                'status' => Self::CLOSED_STATUS,
                'text' => translate('Closed'),
                'route_name' => 'admin.shipments.closed.index',
                'permissions' => 1017,
                'route_url' => 'closed'
            ],

            [
                'status' => Self::CAPTAIN_ASSIGNED_STATUS,
                'text' => translate('Assigned'),
                'route_name' => 'admin.shipments.assigned.index',
                'permissions' => 1018,
                'route_url' => 'assigned'
            ],

            [
                'status' => Self::RECIVED_STATUS,
                'text' => translate('Received'),
                'route_name' => 'admin.shipments.captain.given.index',
                'permissions' => 1019,
                'route_url' => 'deliverd-to-driver'
            ],
            [
                'status' => Self::DELIVERED_STATUS,
                'text' => translate('Deliverd'),
                'route_name' => 'admin.shipments.delivred.index',
                'permissions' => 1020,
                'route_url' => 'delivred'
            ],
            [
                'status' => Self::SUPPLIED_STATUS,
                'text' => translate('Supplied'),
                'route_name' => 'admin.shipments.supplied.index',
                'permissions' => 1041,
                'route_url' => 'supplied'
            ],

            [
                'status' => Self::IN_STOCK_STATUS,
                'text' => translate('In Stock'),
                'route_name' => 'admin.shipments.instock.index',
                'permissions' => 1022,
                'route_url' => 'in-stock'
            ],

            [
                'status' => Self::PENDING_STATUS,
                'text' => translate('Pending'),
                'route_name' => 'admin.shipments.pending.index',
                'permissions' => 1023,
                'route_url' => 'pending'
            ],

            [
                'status' => Self::RETURNED_STATUS,
                'text' => translate('Returned'),
                'route_name' => 'admin.shipments.returned.sender.index',
                'permissions' => 1024,
                'route_url' => 'returned-on-sender'
            ],

            [
                'status' => Self::RETURNED_STOCK,
                'text' => translate('Returned Stock'),
                'route_name' => 'admin.shipments.returned.stock.index',
                'permissions' => 1025,
                'route_url' => 'returned-stock'
            ],

            [
                'status' => Self::RETURNED_CLIENT_GIVEN,
                'text' => translate('Returned & Deliverd'),
                'route_name' => 'admin.shipments.returned.deliverd.index',
                'permissions' => 1026,
                'route_url' => 'returned-deliverd'
            ],



        ];
        return $array;
    }
    public function getStatus()
    {
        $result = null;
        foreach (Self::status_info() as $status) {
            $status_id = $this->status_id;
            $result = (isset($status['status']) && $status['status'] == $status_id) ? $status['text'] : null;
            if ($result != null) {
                return $result;
            }
        }

        return $result;
    }
    static public function getStatusByStatusId($status_id_attr)
    {
        $result = null;
        foreach (Self::status_info() as $status) {
            $status_id = $status_id_attr;
            $result = (isset($status['status']) && $status['status'] == $status_id) ? $status['text'] : null;
            if ($result != null) {
                return $result;
            }
        }

        return $result;
    }

    static public function getStatusByRoute($route_name)
    {
        $result = null;
        foreach (Self::status_info() as $status) {
            $result = (isset($status['route_name']) && $status['route_name'] == $route_name) ? $status['status'] : null;
            return $result;
        }
        return $result;
    }

    public function getTypeAttribute($value)
    {
        if ($value == Self::DROPOFF) {
            return translate('Dropoff');
        } elseif ($value == Self::PICKUP) {
            return translate('Pickup');
        }
    }

    static public function getType($value)
    {
        if ($value == Self::DROPOFF) {
            return translate('Dropoff');
        } elseif ($value == Self::PICKUP) {
            return translate('Pickup');
        } else {
            return null;
        }
    }

    public function getPaymentMethodAttribute($value)
    {
        if ($value == Self::CASH_METHOD) {
            return translate('Cash');
        } elseif ($value == Self::PAYPAL_METHOD) {
            return translate('Paypal');
        }
    }
    public function getPaymentType()
    {
        if ($this->payment_type == Self::POSTPAID) {
            return translate('Postpaid');
        } elseif ($this->payment_type == Self::PREPAID) {
            return translate('Prepaid');
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

    public function logs()
    {
        return $this->hasMany('App\ShipmentLog', 'shipment_id', 'id');
    }

    public function from_country(){
		return $this->hasOne('App\Country', 'id' , 'from_country_id');
	}
    public function to_country(){
		return $this->hasOne('App\Country', 'id' , 'to_country_id');
	}
    public function from_state(){
		return $this->hasOne('App\State', 'id' , 'from_state_id');
	}
    public function to_state(){
		return $this->hasOne('App\State', 'id' , 'to_state_id');
	}
    public function from_area(){
		return $this->hasOne('App\Area', 'id' , 'from_area_id');
	}
    public function to_area(){
		return $this->hasOne('App\Area', 'id' , 'to_area_id');
	}
}
