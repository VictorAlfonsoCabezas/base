<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatBotDetail extends Model
{
    protected $table = 'chat_bot_detail';
    protected $fillable = [
        'id',
        'company_id',
        'date_created',
        'chat_bot_header_id',
        'bot_detail_id',
        'api_header_id',
        'first_message',
        'last_message',
        'bot_question',
        'bot_historial_id',
        'customer_address_id',
        'customer_answer',
        'description',
        'bot',
        'date_format',
        'date_real',
        'time_real',
        'messagenumber',
        'viewed',
        'action',
        'user_write_id',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function chatBotHeader()
    {
        return $this->belongsTo('App\Models\ChatBotHeader', 'chat_bot_header_id');
    }
    public function botDetail()
    {
        return $this->belongsTo('App\Models\BotDetail', 'bot_detail_id');
    }
    public function apiHeader()
    {
        return $this->belongsTo('App\Models\ApiHeader', 'api_header_id');
    }
    public function botHistorial()
    {
        return $this->belongsTo('App\Models\BotHistorial', 'bot_historial_id');
    }
    public function customerAddress()
    {
        return $this->belongsTo('App\Models\CustomerAddress', 'customer_address_id');
    }
    public function userWrite()
    {
        return $this->belongsTo('App\User', 'user_write_id');
    }
}
