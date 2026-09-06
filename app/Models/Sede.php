<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table = 'sede';
    protected $fillable = [
        'id',
        'company_id',
        'principal',
        'date_created',
        'name',
        'code_intel',
        'city_id',
        'latitud',
        'longitud',
        'instancia',
        'token',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public static function boot()
    {
        parent::boot();
        // self::creating(function($model){
        //     // ... code here
        // });

        // self::created(function ($model) {
          //     // ... code here 
        // });

        // self::updating(function($model){
        //     // ... code here
        // });

        self::updated(function ($model) {
            $sedePrincipal = Sede::find($model->id);
            if($sedePrincipal->principal){
                $empresa = Company::find($sedePrincipal->company_id);
                $empresa->latitud = $model->latitud;
                $empresa->longitud = $model->longitud;
                $empresa->instancia = $model->instancia;
                $empresa->token_chatapi = $model->token;
                $empresa->save();
            }
        });

        // self::deleting(function($model){
        //     // ... code here
        // });

        // self::deleted(function ($model) {
            //     // ... code here
        // });
    }
}
