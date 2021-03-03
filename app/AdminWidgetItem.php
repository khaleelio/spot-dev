<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminWidgetItem extends Model
{
    public function widget(){
        return $this->belongsTo(AdminWidget::class, 'widget_id');
    }

    public function parent(){
        return $this->belongsTo(AdminWidgetItem::class, 'parent');
    }

    public function children(){
        return $this->hasMany(AdminWidgetItem::class, 'parent');
    }
}
