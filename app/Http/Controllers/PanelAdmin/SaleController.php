<?php

namespace App\Http\Controllers\PanelAdmin;

use App\AdverImage;
use App\Advertising;
use App\Brand;
use App\Expert;
use App\Http\Resources\Adver;
use App\Models;
use App\Notifications\AcceptSaleAdver;
use App\Notifications\NewSaleAdver;
use App\Notifications\NewSaleAdverForExpert;
use App\User;
use Carbon\Carbon;
use DB;
use Facades\App\Repositories\Cache\BodiesStatusRepository;
use Facades\App\Repositories\Cache\CarStatusRepository;
use Facades\App\Repositories\Cache\CashStatusRepository;
use Facades\App\Repositories\Cache\ChassiTypeRepository;
use Facades\App\Repositories\Cache\DifferentialRepository;
use Facades\App\Repositories\Cache\GearboxStatusRepository;
use Facades\App\Repositories\Cache\PlaceStainesRepository;
use Facades\App\Repositories\Cache\ProductionRepository;
use Facades\App\Repositories\Cache\CityRepository;
use Facades\App\Repositories\Cache\TownRepository;
use Facades\App\Repositories\Cache\ColorRepository;
use App\Sale;
use App\Http\Controllers\Controller;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Redirect;
use Symfony\Component\Console\Input\Input;
use Validator;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sales = Sale::with('adver')->orderBy('id', 'desc')->paginate(15);
        return view('SaleAdver.index',compact('sales'));
    }

    public function store(Request $request)
    {
        //validate requests
        $validator = Validator::make($request->all(), $this->rules($request));
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        DB::beginTransaction();

        try {
            // Validate, then create if valid
            $expert = Expert::where('id',$request->expert_id)->with('user')->first();
            $user = User::find($expert->user->id);
            $adver = Advertising::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'brand_id' => $request->brand,
                'model_id' => $request->model,
                'expert_id' => $expert->id,
                'user_id' => $user->id,
            ]);

        } catch(ValidationException $e)
        {
            DB::rollback();
            return Redirect::back()->withErrors( $e->getErrors() ) ->withInput();
        } catch(\Exception $e)
        {
            DB::rollback();
            throw $e;
        }

        if ($request->hasFile('image')) {
            try {
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
            } catch(ValidationException $e)
            {
                DB::rollback();
                return Redirect::back()->withErrors( $e->getErrors() ) ->withInput();
            } catch(\Exception $e)
            {
                DB::rollback();
                throw $e;
            }
        }

        try {
            $sale = new Sale;
            $sale->production_id = $request->production;
            $sale->color_id = $request->color;//رنگ خودرو
            $sale->price = $request->price;
            $sale->bodystatus_id = $request->bodystatus;//چند لکه
            $sale->placestain_id = json_encode($request->placestain); //محل نقطه
            $sale->amortization = $request->amortization; //میزان کارکرد
            $sale->city_id = $request->city;
            $sale->town_id = $request->town;
            $sale->description = $request->description;
            $sale->status = $request->status;
//            $sale->type = 'manual';

            $sale->in_place = $request->in_place;
            $sale->cash = $request->cash;
            $sale->chassi_type = $request->chassistype;
            $sale->girbox = $request->gearboxstatus;
            $sale->car_status = $request->carstatus;
            $sale->differential = $request->differential;

            $sale->save();

            $adver = Advertising::find($adver->id);
            $findSale = Sale::find($sale->id);
            $adver->sale()->associate($findSale)->save();

        } catch(ValidationException $e)
        {
            DB::rollback();
            return Redirect::back()->withErrors( $e->getErrors() ) ->withInput();
        } catch(\Exception $e)
        {
            DB::rollback();
            throw $e;
        }

        DB::commit();
        $user->notify(new NewSaleAdverForExpert($adver));
        return Redirect::route('sale.edit',$sale->id)->with('success','آگهی با موفقیت ثبت شد.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($saleId = null)
    {
        $expert = Expert::where('id',$saleId)->with('user')->with('properties')->first();
        $brands = Brand::all();
        $models = Models::all();
        $productions = ProductionRepository::all();
        $cities = CityRepository::all();
        $towns = TownRepository::all();
        $colors =  ColorRepository::all();
        $bodystatuses = BodiesStatusRepository::all();
        $placeStaines = PlaceStainesRepository::all();
        $cashes =  CashStatusRepository::all();
        $chassistypes = ChassiTypeRepository::all();
        $gearboxstatuses = GearboxStatusRepository::all();
        $carstatuses = CarStatusRepository::all();
        $differentiales = DifferentialRepository::all();

        //place stain expert to array for choose automatic form
        if(!empty($expert->properties) && !empty($expert->properties->paint)) {
            $expertProperties = json_decode($expert->properties->paint);
            $expertProperties = explode(',', $expertProperties->placestain);
        } else {
            $expertProperties = null;
        }

        return view('SaleAdver.create',compact('expert','brands','models','productions','cities','towns','colors','bodystatuses','placeStaines','expertProperties','cashes','chassistypes','gearboxstatuses','carstatuses','differentiales'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //check exist sale adver
        $sale = Sale::where('id',$id)->with('adver')->first();
        $brands = Brand::all();
        $models = Models::all();
        $productions = ProductionRepository::all();
        $cities = CityRepository::all();
        $towns = TownRepository::all();
        $colors =  ColorRepository::all();
        $cashes =  CashStatusRepository::all();
        $chassistypes = ChassiTypeRepository::all();
        $gearboxstatuses = GearboxStatusRepository::all();
        $carstatuses = CarStatusRepository::all();
        $differentiales = DifferentialRepository::all();
        $adver = Advertising::where('id',$sale->adver->id)->with('sale')->with('images')->first();
        if (!$sale) {
            return Redirect::back()->withErrors('چنین آگهی وجود ندارد');
        }

        return view('SaleAdver.edit',compact('sale','brands','models','productions','cities','towns','colors','adver','cashes','chassistypes','gearboxstatuses','carstatuses','differentiales'));

    }

    /**
     * list rules for check field input
     * @return array
     */
    public function rules($request)
    {
        $ruleSaleAdv = [
            'title' => 'required|string|min:2|max:500',
            'slug' => 'string|min:2|max:500',
            'brand' => 'required|integer',
            'model' => 'required|integer',
            'production' => 'required|integer', //سال ساخت
            'color' => 'nullable|integer', //رنگ خودرو
            'price' => 'required|integer',
//            'bodystatus' => 'required|integer',
//            'placestain' => 'nullable|array',//محل نقطه
//            'placestain.*' => 'required|integer',//محل نقطه
            'amortization' => 'required|integer',//میزان کارکرد
            'city' => 'required|integer', //استان
            'town' => 'required|integer', //شهر
            'description' => 'required|string',
            'deleteimages' => 'array',
            'deleteimages.*' => 'integer',
            'in_place' => 'in:true,false',
            'cash' => 'required|integer|between:1,2',
            'chassistype' => 'required|integer|between:1,6',
            'gearboxstatus' => 'required|integer|between:1,2',
            'carstatus' => 'required|integer|between:1,5',
            'differential' => 'required|integer|between:1,3',
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:10240',
        ];

        return $ruleSaleAdv;
    }

    /**
     * Update sale
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //validate requests
        $validator = Validator::make($request->all(), $this->rules($request));
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }

        $sale = Sale::find($id);
        $sale->production_id = $request->production;
        $sale->color_id = $request->color;
        $sale->price = $request->price;

        $sale->in_place = $request->in_place;
        $sale->cash = $request->cash;
        $sale->chassi_type = $request->chassistype;
        $sale->girbox = $request->gearboxstatus;
        $sale->car_status = $request->carstatus;
        $sale->differential = $request->differential;

        $sale->amortization = $request->amortization;
        $sale->city_id = $request->city;
        $sale->town_id = $request->town;
        $sale->description = $request->description;

        if ($request->has('status')) {
            $sale->status = $request->status;
        }


        $adver = $sale->adver;
        $adver->title = $request->title;
        $adver->slug = $request->slug;
        $adver->brand_id = $request->brand;
        $adver->model_id = $request->model;
        $sale->adver()->save($adver);

//        return $adver->images;

        //check request and save this
        if ($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
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


        //remove images
        if ($request->has('deleteimages'))
        {
            AdverImage::whereIn('id',$request->deleteimages)->delete();
        }

        if ($request->status == 1) {
            $user = User::find($adver->user->id);
            $user->notify(new AcceptSaleAdver($adver));
        }

        $sale->save();

        return Redirect::back()->with('success','آگهی با موفقیت بروز رسانی شد.');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->adver()->delete();
        $sale->delete();
        return Redirect::back()->with('success','آگهی با موفقیت حذف شد.');
    }

}
