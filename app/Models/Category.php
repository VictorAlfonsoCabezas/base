<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $table = 'category';
    protected $fillable = [
        'id', 'title', 'name', 'description', 'type', 'type_name',
        'sub_type', 'photo', 'use_description', 'use_selection',
        'use_label', 'label', 'opcion1', 'opcion2', 'opcion3', 'status'
    ];
}
