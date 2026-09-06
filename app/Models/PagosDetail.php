<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagosDetail extends Model
{
    protected $table = 'pagos_detail';
    protected $fillable = [
        'id',
        'date_created',
        'company_id',
        'chat_bot_header_id',
        'pagos_header_id',
        'pay_payment_method',
        'pay_ticket_number',
        'pay_status',
        'code_kushki',
        'kushki_id',
        'status',
    ];
    
    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function chatBotHeader() {
        return $this->belongsTo('App\Models\ChatBotHeader', 'chat_bot_header_id');
    }
    public function pagosHeader() {
        return $this->belongsTo('App\Models\ChatBotHeader', 'pagos_header_id');
    }
    
}
