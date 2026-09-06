<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendHeader extends Model {

    protected $table = 'send_header';
    protected $fillable = [
        'id',
        'company_id',
        'campania',
        'customer_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'text',
        'date_created',
        'hour_created',
        'observation',
        'status'
    ];
    
    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

}
