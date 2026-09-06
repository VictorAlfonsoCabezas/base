<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Kushki\KushkiController;
use Illuminate\Http\Request;
use App\Models\Region;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class WebhooksOrionController extends Controller
{
    public static function webhookorion(Request $request)
    {
        $data = [
            'name' => 'entraaaaaaa ORION',
        ];
        Region::create($data);

        $data = [
            'name' => json_encode($request->all()),
        ];
        Region::create($data);

        return response(null, 200);
    }
}
