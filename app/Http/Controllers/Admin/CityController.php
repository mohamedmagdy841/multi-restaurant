<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /// city
    public function allCity()
    {
        $city = City::latest()->get();
        return view('admin.backend.city.all_city', compact('city'));
    }

    public function storeCity(Request $request)
    {

        City::create([
            'city_name' => $request->city_name,
            'city_slug' =>  strtolower(str_replace(' ','-',$request->city_name)),
        ]);

        return redirect()->back()->with([
            'message' => 'City Inserted Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function editCity($id)
    {
        $city = City::find($id);
        return response()->json($city);
    }

    public function updateCity(Request $request)
    {
        $cat_id = $request->cat_id;
        City::find($cat_id)->update([
            'city_name' => $request->city_name,
            'city_slug' =>  strtolower(str_replace(' ','-',$request->city_name)),
        ]);

        return redirect()->back()->with([
            'message' => 'City Updated Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function deleteCity($id)
    {
        City::find($id)->delete();

        return redirect()->back()->with([
            'message' => 'City Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
}
