<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotConection extends Model
{
    protected $table = 'bot_conection';
    protected $fillable = [
        'id',
        'name',
        'description',
        'status'
    ];
}