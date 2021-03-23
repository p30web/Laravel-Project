<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Expert;
use App\Http\Controllers\AuthenticationController;
use DB;
use Facades\App\Repositories\Cache\PlaceStainesRepository;
use Facades\App\Repositories\Cache\ProductionRepository;
use Facades\App\Repositories\Cache\BodiesStatusRepository;
use Facades\App\Repositories\Cache\CityRepository;
use Facades\App\Repositories\Cache\ColorRepository;
use Facades\App\Repositories\Cache\TownRepository;
use Facades\App\Repositories\Cache\ChassiTypeRepository;
use Facades\App\Repositories\Cache\CashStatusRepository;
use Facades\App\Repositories\Cache\GearboxStatusRepository;
use Facades\App\Repositories\Cache\CarStatusRepository;
use Facades\App\Repositories\Cache\DifferentialRepository;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;
use Validator;

class ApiController extends BaseController
{

    public function getCashes()
    {
        $cash = CashStatusRepository::all();
        return response()->json($cash, 200);
    }

    public function getGearboxStatuses()
    {
        $gearboxStatuses = GearboxStatusRepository::all();
        return response()->json($gearboxStatuses, 200);
    }

    public function getCarStatuses()
    {
        $carStatuses = CarStatusRepository::all();
        return response()->json($carStatuses, 200);
    }

    public function getDifferentials()
    {
        $differentials = DifferentialRepository::all();
        return response()->json($differentials, 200);
    }

    public function getChassiTypes()
    {
        $chassiType = ChassiTypeRepository::all();
        return response()->json($chassiType, 200);
    }

    /**
     * return all cities from cache
     *
     * @return JsonResponse
     */
    public function getCities()
    {
        //        $start = microtime(true);
        $cities = CityRepository::all();
//        $duration = (microtime(true) - $start) * 1000;
        return response()->json($cities, 200);
    }


    /**
     * get City title By id
     *
     * @param $id
     * @return mixed
     */
    public function getTitleCityById($id)
    {
        $city = CityRepository::find($id,['title']);
        return $city->title;
    }


    /**
     * return all colors from cache
     *
     * @return JsonResponse
     */
    public function getColors()
    {
        $colors = ColorRepository::all();
        return response()->json($colors, 200);
    }

    /**
     * get color title By id
     *
     * @return \Illuminate\Http\Response
     */
    public function getTitleColorById($id)
    {
        $color = ColorRepository::find($id,['title']);
        return $color->title;
    }


    /**
     * return all productions from cache
     *
     * @return JsonResponse
     */
    public function getProductions()
    {
        $production = ProductionRepository::all();
        return response()->json($production, 200);
    }

    /**
     * return all productions from cache
     *
     * @return JsonResponse
     */
    public function getProductionById($id)
    {
        $production = ProductionRepository::find($id,['slug']);
        return $production->slug;
    }

    /**
     * return all bodies status from cache
     *
     * @return JsonResponse
     */
    public function getBodiesStatus()
    {
        $bodiesStatus = BodiesStatusRepository::all();
        return response()->json($bodiesStatus, 200);
    }


    /**
     * get title bodies status by id
     *
     * @param $id
     * @return mixed
     */
    public function getTitleBodiesStatusById($id)
    {
        $bodiesStatus = BodiesStatusRepository::find($id,['title']);
        return $bodiesStatus->title;
    }

    /**
     * return all towns from cache
     *
     * @return \Illuminate\Http\Response
     */
    public function getTowns()
    {
        $towns  = TownRepository::all();
        return response()->json($towns, 200);
    }


    /**
     * return all cities from cache
     *
     * @return JsonResponse
     */
    public function getTownsById($id)
    {
        $towns = TownRepository::find($id,['title']);
        return response()->json($towns, 200);
    }

    /**
     * get title bodies status by id
     *
     * @param $id
     * @return mixed
     */
    public function getTitleTownById($id)
    {
        $town  = DB::table('towns')->where('id',$id)->select('title')->first();
        return $town->title;
    }

    /**
     * return all place staines from cache
     *
     * @return mixed
     */
    public function getPlaceStaines()
    {
        $placeStaines  = PlaceStainesRepository::all();
        return response()->json($placeStaines, 200);
    }

    /**
     * check auth user | Login & Register
     *
     * @param Request $request
     * @return JsonResponse|MessageBag
     */
    public function checkAuthUser(Request $request)
    {
        $rules = [
            'phone_number' => 'required','regex:/^09[0-9]{9}$/',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $auth = new AuthenticationController();
        if ($auth->checkUserExistJustPhone($request->phone_number))
            return $this->sendResponse(null,'یوزر ثبت نام شده است.');

        return $this->sendError('یوزر ثبت نام نشده است.');
    }

}
