<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentSetting extends Model
{
    protected $table = "shipment_settings";
    protected $guarded = [];

    static public function getVal($key)
    {
        $value = null;
        $setting = Self::where('key',$key)->first();
        if($setting != null)
        {
            $value = $setting->value;
        }
        return $value;
    }
}
