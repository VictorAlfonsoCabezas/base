<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use Response;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::all();
        $countries = Country::where('status', true)->get();
        return view('city/index')
            ->with('cities', $cities)
            ->with('countries', $countries);
    }
    public function store(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'country_id' => $request->input('country_id'),
            'code' => $request->input('code')
        ];
        City::create($data);
        return Response::json(true);
    }

    public function update(Request $request, $id)
    {
        $city = City::find($id);
        $city->name = $request->input('name');
        $city->country_id = $request->input('country_id');
        $city->code = $request->input('code');
        $city->save();
        return Response::json(true);
    }

    public function edit($id)
    {
        $city = City::find($id);
        return Response::json($city);
    }

    public static function createUpdateCity($datos, $respCountry)
    {
        $city = City::where('code', $datos['ciudad_code']);
        if ($city->count() == 0) {
            $dataCity = [
                'name' => $datos['ciudad'],
                'code' => $datos['ciudad_code'],
                'country_id' => $respCountry,
            ];
            $city = City::create($dataCity);
            $respCity = $city->id;
        } else {
            $city = $city->first();
            $city->name = $datos['ciudad'];
            $city->country_id = $respCountry;
            $city->save();
            $respCity = $city->id;
        }
        return $respCity;
    }
}
