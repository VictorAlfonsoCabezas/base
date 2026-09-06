<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;

class DesactivarInterconexion extends Command
{
    protected $signature = 'desactivar:interconexion';

    protected $description = 'Desactivar Interconexion';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $company = Company::where('whatsapp_conexion', true)
            ->where('status', true)
            ->get();
        if (count($company)) {
            foreach ($company as $key => $value) {
                $companyActive = Company::find($value->id);
                $companyActive->whatsapp_conexion = false;
                $companyActive->save();
            }
        }
    }
}
