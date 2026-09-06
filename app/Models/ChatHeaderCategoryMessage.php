<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatHeaderCategoryMessage extends Model
{
    protected $table = 'chat_header_category_message';
    protected $fillable = [
        'id',
        'company_id',
        'date_created',
        'category_message_id',
        'chat_bot_header_id'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function categoryMessage()
    {
        return $this->belongsTo('App\Models\CategoryMessage', 'category_message_id');
    }
    public function chatBotHeader()
    {
        return $this->belongsTo('App\Models\ChatBotHeader', 'chat_bot_header_id');
    }
}
