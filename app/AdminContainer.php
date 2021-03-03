<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminContainer extends Model
{
    public function container_widget(){
        return $this->hasMany(AdminContainerWidget::class, 'container_id')->orderBy('sort', 'asc');
    }
}
