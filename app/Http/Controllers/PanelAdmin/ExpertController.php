<?php

namespace App\Http\Controllers\PanelAdmin;

use App\Brand;
use App\Expert;
use App\Http\Controllers\Api\Reserve\ReserveController;
use App\Models;
use App\Package;
use Facades\App\Repositories\Cache\HealthStatusRepository;
use Facades\App\Repositories\Cache\BodiesStatusRepository;
use Facades\App\Repositories\Cache\PlaceStainesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Validator;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experts = Expert::with('user')->with('reserve')->orderBy('id', 'desc')->paginate(5);
//        return  json_decode($experts[0]->reserve->reserveDate,true)['time'];
        return view('ExpertAdver.index',compact('experts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        //check exist expert adver
        $expert = Expert::where('id',$id)->with('user')->with('reserve')->with('properties')->with('adver')->first();
        $brands = Brand::all();
        $models = Models::all();
        $packages = Package::all();
        $health_status = HealthStatusRepository::all();

        $reserve = new ReserveController();
        $dates = $reserve->getDatesById(1,null);
        $plaque = json_decode($expert->plaque , true);

        $batteryHealth = json_decode($expert->properties['battery_health'],true);
        $mechanic = json_decode($expert->properties['mechanic'],true);
        $paint = json_decode($expert->properties['paint'],true);
        $electric = json_decode($expert->properties['electric'],true);
        $safety = json_decode($expert->properties['safety'],true);
        $wheels = json_decode($expert->properties['wheels'],true);
        $check_documents = json_decode($expert->properties['check_document'],true);
        $check_options = json_decode($expert->properties['check_option'],true);

        $bodystatuses = BodiesStatusRepository::all();
        $placeStaines = PlaceStainesRepository::all();

//        dd(empty($batteryHealth['atributies']));

        if ($expert) {
            return view('ExpertAdver.edit',compact('expert','brands','models','plaque','packages','dates','batteryHealth','mechanic','paint','electric','safety','wheels','bodystatuses','placeStaines','check_documents','check_options','health_status'));
        }


    }


    /**
     * list rules for check field input
     * @return array
     */
    public function rules()
    {
        $ruleExpertAdv = [
            'plaque.iran' => 'required|numeric|between:10,99',
            'plaque.alphabet' => 'required|alpha',
            'plaque.first' => 'required|numeric|between:10,99',
            'plaque.second' => 'required|numeric|between:111,999',
            'package' => 'required|array',
            'package.*' => 'required|integer',
            'reserveDate' => [
                'required',
                'date_format:Y/m/d'
            ] ,
            'reserveTime' => 'required|date_format:H:i:s'
        ];

        return $ruleExpertAdv;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //validate requests
        $validator = Validator::make($request->all(), $this->rules($request));
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }


        $plaque = [
            'iran' => $request->plaque['iran'],
            'first' => $request->plaque['first'] ,
            'alphabet' => $request->plaque['alphabet'] ,
            'second' => $request->plaque['second'],
        ];

        $expert = Expert::find($id);

        $expert->plaque = json_encode($plaque);
        $expert->reserve->packages()->sync($request->package);
        $expert->brand_id = $request->brand;
        $expert->model_id = $request->model;
        $expert->save();

        //update reserve
        $reserve = [
            'date' => $request->reserveDate,
            'time' => $request->reserveTime,
        ];
        $reservvv = $expert->reserve;
        $reservvv->reserveDate = json_encode($reserve);
        $reservvv->save();

        return Redirect::back()->with('success','آگهی با موفقیت بروز رسانی شد.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $expert = Expert::find( $id );
        $expert->reserve()->delete();
        $expert->invoices()->delete();
        $expert->delete();
        return Redirect::back()->with('success','آگهی با موفقیت حذف شد.');
    }
}
