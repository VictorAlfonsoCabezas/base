<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryMessage extends Model
{
    protected $table = 'category_message';
    protected $fillable = [
        'id',
        'company_id',
        'date_created',
        'name',
        'description',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
