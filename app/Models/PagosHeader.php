<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagosHeader extends Model
{
    protected $table = 'pagos_header';
    protected $fillable = [
       'id',
       'date_created',
       'company_id',
       'chat_bot_header_id',
       'pay_smart_link_url',
       'pay_smart_link',
       'pay_status',
       'status'
    ];
    
    public function company() {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
