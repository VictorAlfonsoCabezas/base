<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiIntention extends Model
{
    protected $table = 'api_intention';
    protected $fillable = [
        'id',
        'date_created',
        'company_id',
        'api_header_id',
        'bot_intention_id',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function apiHeader()
    {
        return $this->belongsTo('App\Models\BotHeader', 'api_header_id');
    }

    public function botIntention()
    {
        return $this->belongsTo('App\Models\api_detail', 'bot_intention_id');
    }
}
