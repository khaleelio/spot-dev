<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminWidget extends Model
{
    public function item(){
        return $this->hasMany(AdminWidgetItem::class, 'widget_id');
    }
}
