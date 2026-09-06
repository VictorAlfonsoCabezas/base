<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotIntention extends Model
{
    protected $table = 'bot_intention';
    protected $fillable = [
        'id',
        'date_created',
        'name',
        'description',
        'code',
        'status'
    ];
}
