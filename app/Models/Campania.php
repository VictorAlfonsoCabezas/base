<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campania extends Model {

    protected $table = 'campania';
    protected $fillable = [
        'id',
        'company_id',
        'code_intel',
        'title',
        'description',
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
        'observation',
        'status'
    ];

    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

}
