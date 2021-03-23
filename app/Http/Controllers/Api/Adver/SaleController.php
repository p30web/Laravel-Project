<?php

namespace App\Http\Controllers\Api\Adver;

use App\AdverImage;
use App\Advertising;
use App\Brand;
use App\Http\Controllers\Adver\AdvertisingController;
use App\Http\Controllers\Adver\SaleAdvController;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\AdverCollection;
use App\Models;
use App\Notifications\NewSaleAdver;
use App\Sale;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Throwable;
use Validator;

class SaleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return AdverCollection
     */
    public function index()
    {
        $currentuser = User::find(auth()->user()->id);
        $sale = $currentuser->advers()->whereHas('sale')->with('sale');
        return new AdverCollection($sale->orderBy('id', 'desc')->limit(5)->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand  = Brand::find($request->brand);
        $model = Models::find($request->model);
        if ($brand && $model)
        {
            $request->merge(['title' => $brand->title . ' ' . $model->title]);
        }

        $expert = new SaleAdvController();
        if ($expert->createADS($request)['status'] == true)
        {
            return $this->sendResponse(null, 'عملیات با موفقیت انجام شد.');
        }
        return $this->sendError($expert->createADS($request)['data']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * show result for edit sale
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Request $request ,$id)
    {
        //merge request id for show hidden fields in api
        $request->merge(['id'=>$id]);

        $adver = Advertising::find($id);
        $this->authorize('view', $adver);
        $resource = new \App\Http\Resources\Adver($adver,true);
        return $this->sendResponse($resource,null);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $ruleAdvertiisng = new AdvertisingController();

        $ruleSaleAdv = [
            'production' => 'required|integer', //سال ساخت
            'salestatus' => 'nullable|integer', //وضعیت فروش
            'delete' => 'nullable|boolean', //حذف آگهی
            'color' => 'required|integer', //رنگ خودرو
            'price' => 'required|integer',
            'bodystatus' => 'required|integer',
            'placestain' => 'nullable|array',//محل نقطه
            'placestain.*' => 'required|integer',//محل نقطه
            'amortization' => 'required|integer',//میزان کارکرد
            'city' => 'required|integer', //استان
            'town' => 'required|integer', //شهر
            'description' => 'required|string',
            'cash' => 'required|integer|between:1,2',
            'chassistype' => 'required|integer|between:1,6',
            'gearboxstatus' => 'required|integer|between:1,2',
            'carstatus' => 'required|integer|between:1,5',
            'differential' => 'required|integer|between:1,3',
            'image' => 'nullable|array',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:10240'
        ];

        return $ruleSaleAdv;
//        return array_merge($ruleAdvertiisng->rules(),$ruleSaleAdv);
    }

    /**
     * update sale adver for user
     *
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules($request));
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $adver = Advertising::find($id);
        $this->authorize('update', $adver);

        try {
            DB::transaction(function () use ($adver, $request) {
                $user = User::find(auth()->user()->id);
                //check request and save this
                if ($request->hasFile('image')) {
                    foreach($request->file('image') as $image) {
                        $filenamewithextension = $image->getClientOriginalName();
                        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                        $extension = $image->getClientOriginalExtension();
                        $filenametostore = $filename.'_'.time().'.'.$extension;
                        $img = Image::make($image)->resize(800, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->encode('jpg');
                        $path = $image->storeAs(Carbon::now()->year . '/' . Carbon::now()->month , $filenametostore , 'public');

                        if (!file_exists(public_path('images/') . Carbon::now()->year . '/' . Carbon::now()->month)) {
                            mkdir(public_path('images/') . Carbon::now()->year . '/' . Carbon::now()->month , 666, true);
                        }
                        $img->save(public_path('images/') . $path);

                        $adverImage = new AdverImage();
                        $adverImage->image_path = $path;
                        $adverImage->advertising_id = $adver->id;
                        $adverImage->save();
                    }
                }

                $adver->sale->update([
                    'production_id' => $request->production,
                    'color_id' => $request->color,//رنگ خودرو
                    'price' => $request->price,
                    'cash' => $request->cash,
                    'chassi_type' => $request->chassistype,
                    'girbox' => $request->gearboxstatus,
                    'car_status' => $request->carstatus,
                    'differential' => $request->differential,
                    'bodystatus_id' => $request->bodystatus,
                    'placestain_id' => json_encode($request->placestain),
                    'amortization' => $request->amortization,
                    'city_id' => $request->city,
                    'town_id' => $request->town,
                    'description' => $request->description,
                    'status' => ($request->salestatus == 1? 2 : 4), //2 آی دی فروخته شده است و 4 آی دی اگهی ویرایش شده است
                    'deleteimages' => 'array',
                    'deleteimages.*' => 'integer',
                ]);

                //remove images
                if ($request->has('deleteimages'))
                {
                    AdverImage::whereIn('id',$request->deleteimages)->delete();
                }


            });
            return $this->sendResponse('آگهی با موفقیت ویرایش شد.');
        } catch (Throwable $e) {
            return $this->sendError('هنگام ثبت با خطایی مواجه شد: ' . $e->getMessage());
        }

    }


    public function destroy($id)
    {
        $adver = Advertising::find($id);
        $this->authorize('delete', $adver);

        $adver->sale()->delete();
        $adver->delete();
        return $this->sendError('آگهی شما حذف شد.');
    }
}
