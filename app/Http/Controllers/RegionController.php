<?php

namespace App\Http\Controllers;
use Laravolt\Indonesia\Models\City;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function getCities($id)
{
    $provinceCode = $id;

    if ($provinceCode) {
        $cities = City::where('province_code', $provinceCode)->pluck('name', 'id');
        return response()->json($cities);
    } else {
        return response()->json(['error' => 'Province code is missing'], 400);
    }

}
    public function getAllCities(Request $request){
        if ($request->query('search')) {
            $city = City::where('name','like','%'.$request->query('search').'%')->simplePaginate(10);

        }else{
            $city = City::simplePaginate(10);
        }
        return $this->respondData(true,'success get city', $city, 200);
    }
}
