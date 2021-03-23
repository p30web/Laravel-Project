<?php

namespace App\Http\Controllers\Api;

use App\Models;
use DB;
use Facades\App\Repositories\Cache\ModelRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ModelController extends Controller
{

    /**
     * get color title By id
     *
     * @return Response
     */
    public function getTitleModelById($id)
    {
        $model = ModelRepository::find($id,['title']);
        return $model->title;
    }

    public function getPackageById($modelid)
    {

        $brand  = Models::findOrFail($modelid);
        $packages = DB::table('packages')->where('model_id', '=', $brand->id)->select('id','title','slug')->get();
        return $packages;

    }

}
