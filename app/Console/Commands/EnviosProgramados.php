<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EnviosHeader;

class EnviosProgramados extends Command
{
    protected $signature = 'envios:programados';

    protected $description = 'Envios Programados';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
         $time = date('H:i');
         $header = EnviosHeader::where('envio_ahora', false)
             ->where('envio_programado', true)
             ->whereIn('tipo', ["PROGRAMADO", "MASIVO", "CAMPANIA"])
             ->where('estado_envio', "PENDIENTE")
             ->where('date_programado', date('Y-m-d'))
             ->whereBetween('time_programado', [$time, $time])
             ->where('status', true)
             ->get();
         if(count($header)){
             foreach ($header as $key => $value) {
                 $headerActive = EnviosHeader::find($value->id);
                 $headerActive->envio_ahora = true;
                 $headerActive->save();
             }
         }
    }
}
