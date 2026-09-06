<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suscription extends Model
{

    protected $table = 'suscription';
    protected $fillable = [
        'id',
        'company_id',
        'plan_id',
        'date_created',
        'date_finish',
        'date_finished',
        'renewall',
        'date_renewall',
        'date_cancel_renewall',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function plan()
    {
        return $this->belongsTo('App\Models\Plan', 'plan_id');
    }
}
