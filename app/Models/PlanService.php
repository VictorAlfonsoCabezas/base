<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanService extends Model {

    protected $table = 'plan_services';
    protected $fillable = [
        'id',
        'plan_id',
        'service_id',
        'name',
        'cantidad',
        'status'
    ];
    
    public function plan() {
        return $this->belongsTo('App\Models\Plan', 'plan_id');
    }
    
    public function service() {
        return $this->belongsTo('App\Models\Service', 'service_id');
    }

}
