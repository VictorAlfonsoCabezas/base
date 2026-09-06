<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotDetail extends Model
{
    protected $table = 'bot_detail';
    protected $fillable = [
        'id',
        'company_id',
        'date_created',
        'bot_header_id',
        'description',
        'intention_id',
        'option',
        'api',
        'api_reponse',
        'personalized_response',
        'refresh',
        'location',
        'location_description',
        'guardado',
        'guardar_api',
        'disabled',
        'first_message',
        'last_message',
        'close_chat',
        'main_branch',
        'send_inmediately',
        'home',
        'back',
        'home_principal',
        'agent_start',
        'fecha_agenda',
        'pago_kushki',
        'pay',
        'order',
        'path_file',
        'name_file',
        'file_extention',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function botHeader()
    {
        return $this->belongsTo('App\Models\BotHeader', 'bot_header_id');
    }
    public function intention()
    {
        return $this->belongsTo('App\Models\BotIntention', 'intention_id');
    }

    // public static function boot()
    // {
    // parent::boot();
    // self::creating(function($model){
    //     dd('entraaaa');
    // });

    // self::created(function($model){
    //     // ... code here
    // });

    // self::updating(function($model){
    //     // ... code here
    // });

    // self::updated(function($model){
    //     // ... code here
    // });

    // self::deleting(function($model){
    //     // ... code here
    // });

    // self::deleted(function($model){
    //     // ... code here
    // });
    // }
}
