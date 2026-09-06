<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotHistorial extends Model
{
    protected $table = 'bot_historial';
    protected $fillable = [
        'id',
        'company_id',
        'date_created',
        'bot_header_id',
        'bot_detail_id',
        'api_header_id',
        'api_header_code',
        'api_header_response',
        'api_detail_id',
        'api_parameters_id',
        'opcion',
        'description',
        'last_message',
        'main_detail',
        'main_answer_id',
        'bot_conection_id',
        'order',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function botHeader()
    {
        return $this->belongsTo('App\Models\BotHeader', 'bot_header_id');
    }

    public function apiDetail()
    {
        return $this->belongsTo('App\Models\api_detail', 'api_detail_id');
    }

    public function apiParameters()
    {
        return $this->belongsTo('App\Models\api_parameters', 'api_parameters_id');
    }

    public function botDetail()
    {
        return $this->belongsTo('App\Models\BotDetail', 'bot_detail_id');
    }

    public function mainAnswer()
    {
        return $this->belongsTo('App\Models\BotDetail', 'bot_detail_id');
    }

    public function botConection()
    {
        return $this->belongsTo('App\Models\BotConection', 'bot_conection_id');
    }
}
