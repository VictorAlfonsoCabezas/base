<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotCustomerResponse extends Model
{
    protected $table = 'bot_customer_response';
    protected $fillable = [
        'id',
        'chat_bot_header_id',
        'api_header_id',
        'date_created',
        'table_name',
        'campo_name',
        'json_response',
        'index_response',
        'response_opcion',
        'response_customer',
        'status'
    ];

    public function apiHeader()
    {
        return $this->belongsTo('App\Models\ApiHeader', 'api_header_id');
    }

    public function chatBotHeader()
    {
        return $this->belongsTo('App\Models\ChatBotHeader', 'chat_bot_header_id');
    }
}
