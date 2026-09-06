<?php

namespace App\Http\Controllers\Region;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Response;

class RegionController extends Controller
{

    public function index()
    {
        $regions = Region::where('status', true)->get();
        $countries = Country::all();
        return view('region/index')
            ->with('regions', $regions)
            ->with('countries', $countries);
    }



    public function store(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'country_id' => $request->input('country_id'),
            'code' => $request->input('code')
        ];
        Region::create($data);
        return Response::json(true);
    }

    public function update(Request $request, $id)
    {
        $region = Region::find($id);
        $region->name = $request->input('name');
        $region->country_id = $request->input('country_id');
        $region->code = $request->input('code');
        $region->save();
        return Response::json(true);
    }

    public function edit($id)
    {
        $region = Region::find($id);
        return Response::json($region);
    }
}
