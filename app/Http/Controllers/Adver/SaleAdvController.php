<?php

namespace App\Http\Controllers\Adver;

use App\AdverImage;
use App\Advertising;
use App\Notifications\newAdver;
use App\Notifications\NewSaleAdver;
use App\Sale;
use App\Traits\UploadTrait;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Facades\App\Repositories\Cache\CarStatusRepository;
use Facades\App\Repositories\Cache\CashStatusRepository;
use Facades\App\Repositories\Cache\ChassiTypeRepository;
use Facades\App\Repositories\Cache\DifferentialRepository;
use Facades\App\Repositories\Cache\GearboxStatusRepository;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Throwable;
use Validator;

class SaleAdvController extends Controller
{

    use UploadTrait;

    public function __construct() {
        $this->middleware('auth:api');
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
            'name' => 'required|string|min:2|max:32',
            'family' => 'required|string|min:2|max:32',
            'production' => 'required|integer', //سال ساخت
            'color' => 'required|integer', //رنگ خودرو
            'price' => 'required|integer',
            'bodystatus' => 'required|integer',
            'placestain' => 'required|array',//محل نقطه
            'placestain.*' => 'required|integer',//محل نقطه
            'amortization' => 'required|integer',//میزان کارکرد
            'city' => 'required|integer', //استان
            'town' => 'required|integer', //شهر
            'description' => 'required|string',
            'in_place' => 'in:true,false',
            'cash' => 'required|integer|between:1,2',
            'chassistype' => 'required|integer|between:1,6',
            'gearboxstatus' => 'required|integer|between:1,2',
            'carstatus' => 'required|integer|between:1,5',
            'differential' => 'required|integer|between:1,3',
            'image' => 'required|array',
            'image.*' => 'required|image|mimes:jpeg,png,jpg|max:10240'
        ];

        return array_merge($ruleAdvertiisng->rules(),$ruleSaleAdv);
    }


    public function createADS(Request $request)
    {

        $validator = Validator::make($request->all(), $this->rules($request));
        if ($validator->fails()) {
            return [
                'status' => false,
                'data' =>  $validator->errors(),
            ];
        }

        //check name & family = if null update fields for user
        $user = User::find(auth()->user()->id);
        if ($user->name == null && $user->family == null)
        {
            $user->name = $request->name;
            $user->family = $request->family;
            $user->update();
        }

        try {
            DB::transaction(function () use ($request, $user) {

                $user = User::find(auth()->user()->id);
                $adver = Advertising::create([
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'brand_id' => $request->brand,
                    'model_id' => $request->model,
                    'user_id' => $user->id,
                ]);

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

                $sale = new Sale;
                $sale->production_id = $request->production;
                $sale->color_id = $request->color;//رنگ خودرو
                $sale->price = $request->price;

                $sale->in_place = false;
                $sale->cash = $request->cash;
                $sale->chassi_type = $request->chassistype;
                $sale->girbox = $request->gearboxstatus;
                $sale->car_status = $request->carstatus;
                $sale->differential = $request->differential;

                $sale->bodystatus_id = $request->bodystatus; //چند لکه
                $sale->placestain_id = json_encode($request->placestain); //محل نقطه
                $sale->amortization = $request->amortization; //میزان کارکرد
                $sale->city_id = $request->city;
                $sale->town_id = $request->town;
                $sale->description = $request->description;
                $sale->status = 4 ;
                $sale->save();


                $adver = Advertising::find($adver->id);
                $findSale = Sale::find($sale->id);
                $adver->sale()->associate($findSale)->save();

                $user->notify(new NewSaleAdver($adver));

            });
        } catch (Throwable $e) {
            return [
                'status' => false,
                'data' =>  'هنگام ثبت با خطایی مواجه شد: ' . $e->getMessage(),
            ];
        }

        return [
            'status' => true ,
        ];
    }
}
