<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtentionDetail extends Model
{
    protected $table = 'atention_detail';
    protected $fillable = [
        'id',
        'company_id',
        'atention_header_id',
        'procedures_id',
        'procedures_name',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function atentionHeader()
    {
        return $this->belongsTo('App\Models\AtentionHeader', 'atention_header_id');
    }
}
