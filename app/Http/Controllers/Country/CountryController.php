<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Response;

class CountryController extends Controller
{

    public function index()
    {
        $countries = Country::all();
        return view('country/index')
            ->with('countries', $countries);
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'iso' => $request->input('iso'),
            'code' => $request->input('code')
        ];
        Country::create($data);
        return Response::json(true);
    }

    public function update(Request $request, $id)
    {
        $country = Country::find($id);
        $country->name = $request->input('name');
        $country->iso = $request->input('iso');
        $country->code = $request->input('code');
        $country->save();
        return Response::json(true);
    }

    public function edit($id)
    {
        $country = Country::find($id);
        return Response::json($country);
    }

    public static function createUpdateCountry($datos)
    {
        $country = Country::where('code', $datos['country_code']);
        if ($country->count() == 0) {
            $dataCountry = [
                'name' => $datos['nationality'],
                'code' => $datos['country_code'],
            ];
            $country = Country::create($dataCountry);
            $respCountry = $country->id;
        } else {
            $country = $country->first();
            $country->name = $datos['nationality'];
            $country->save();
            $respCountry = $country->id;
        }
        return $respCountry;
    }
}
