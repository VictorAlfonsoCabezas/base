<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendDetail extends Model {

    protected $table = 'send_detail';
    protected $fillable = [
        'id',
        'company_id',
        'send_header_id',
        'service_id',
        'service_name',
        'campania',
        'customer_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'text',
        'date_created',
        'hour_created',
        'date_send',
        'hour_send',
        'immediately',
        'programmed',
        'repeat',
        'reminder',
        'reminder_type',
        'reminder_valor',
        'recurrence',
        'recurrence_type',
        'recurrence_valor',
        'lapsos',
        'file',
        'file_path',
        'file_name',
        'file_extension',
        'observation',
        'status',
    ];

    public function service() {
        return $this->belongsTo('App\Models\Service', 'service_id');
    }

}
