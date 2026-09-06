<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatBotHeader extends Model
{
    protected $table = 'chat_bot_header';
    protected $fillable = [
        'id',
        'company_id',
        'sede_id',
        'date_created',
        'bot_header_id',
        'customer_id',
        'customer_factura_id',
        'bot_conection_id',
        'name',
        'description',
        'chatId',
        'pay_smart_link_url',
        'pay_smart_link',
        'pay_payment_method',
        'chapay_ticket_numbertId',
        'pay_status',
        'factura_ruc',
        'factura_nombres',
        'factura_apellidos',
        'factura_nacimiento',
        'factura_email',
        'factura_celular',
        'factura_direccion',
        'agente',
        'status_venta',
        'user_assigned_id',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function sede()
    {
        return $this->belongsTo('App\Models\Sede', 'sede_id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
    public function botHeader()
    {
        return $this->belongsTo('App\Models\BotHeader', 'bot_header_id');
    }
    public function botConection()
    {
        return $this->belongsTo('App\Models\BotConection', 'bot_conection_id');
    }
    public function userAssigned()
    {
        return $this->belongsTo('App\User', 'user_assigned_id');
    }
}
