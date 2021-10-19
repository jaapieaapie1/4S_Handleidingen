<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Type;

class BrandController extends Controller
{
    public function show($brand_id, $brand_slug)
    {

        $brand = Brand::findOrFail($brand_id);
        $types = Type::where('brand_id', $brand_id)->orderBy('name')->get();

        $populars = Type::query()->where("brand_id", "=", $brand_id)->orderBy("visits")->limit(5)->get()->all();

        return view('pages/type_list', [
            "types"=>$types,
            "brand"=>$brand,
            "populars"=>$populars,
        ]);

    }
}
