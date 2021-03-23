<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use App\Brand;
use App\Http\Controllers\Controller;
use Facades\App\Repositories\Cache\BrandRepository;

class BrandController extends Controller
{
    public function getBrands()
    {
        $brands = BrandRepository::all();
        return response()->json($brands, 200);
    }

    /**
     * get color title By id
     *
     * @return Response
     */
    public function getTitleBrandById($id)
    {
        $brand = BrandRepository::find($id,['title']);
        return $brand->title;
    }


    public function getModelById($id)
    {
        $brand  = Brand::find($id);
        return (Brand::find($id) ? $brand->models : response()->json('هیچ برندی برای این مدل یافت نشد.',403));
    }
}
