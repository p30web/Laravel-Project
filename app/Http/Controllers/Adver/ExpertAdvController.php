<?php

namespace App\Http\Controllers\Adver;

use App\Advertising;
use App\Expert;
use App\ExpertProperties;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\Reserve\ReserveController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PanelAdmin\PaymentController;
use App\Invoice;
use App\Location;
use App\Notifications\newAdver;
use App\Notifications\NewExpertAdver;
use App\Package;
use App\Payment;
use App\Reserve;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Throwable;
use Validator;

class ExpertAdvController extends BaseController
{

    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * list rules for check field input
     * @return array
     */
    public function rules($request)
    {

        $ruleAdvertiisng = new AdvertisingController();
        $reserve = new ReserveController();
        $ruleExpertAdv = [
            'plaque.iran' => 'required|numeric|between:10,99',
            'plaque.alphabet' => 'required|alpha',
            'plaque.first' => 'required|numeric|between:10,99',
            'plaque.second' => 'required|numeric|between:100,999',
            'name' => 'required|string|min:2|max:32',
            'family' => 'required|string|min:2|max:32',
            'package' => 'required|array',
            'package.*' => 'required|integer',
            'reserveDate' => [
                'required',
                'date_format:Y/m/d',
                Rule::in($reserve->getDatesById(1,null))
            ] ,
            'reserveTime' => 'required|date_format:H:i:s'
        ];

        return array_merge($ruleAdvertiisng->rules(),$ruleExpertAdv);
    }

    /**
     * @param Request $request
     * @return array
     * @throws Throwable
     */
    public function createADE(Request $request)
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


        DB::transaction(function() use ($request , $user)
        {

            $plaque = [
                'iran' => $request->plaque['iran'],
                'first' => $request->plaque['first'] ,
                'alphabet' => $request->plaque['alphabet'] ,
                'second' => $request->plaque['second'],
            ];

            $expert = Expert::create([
                'plaque' => json_encode($plaque),
                'location_id' => 1,
                'brand_id' => $request->brand,
                'model_id' => $request->model,
                'user_id' => $user->id,
                'status' => 0
            ]);

//            $adver = Advertising::create([
//                'title' => $request->title,
//                'slug' => $request->slug,
//                'brand_id' => $request->brand,
//                'model_id' => $request->model,
//                'user_id' => $user->id,
//            ]);

//            $adver = Advertising::find($adver->id);
            $findExpert = Expert::find($expert->id);
//            $adver->expert()->associate($findExpert)->save();


            $reserve = [
                'date' => $request->reserveDate,
                'time' => $request->reserveTime,
            ];
            $res = Reserve::create([
                'expert_id' => $findExpert->id,
                'reserveDate' => json_encode($reserve),
//                'reserveDetails' => json_encode($request->package),
            ]);

            $res->packages()->attach($request->package);


            //COMPUTING PRICE PACKAGES
            $reserve = Reserve::find($res->id);
            $packages = new PackageController();
            $invoice = Invoice::create([
                'user_id' => $user->id,
                'expert_id' => $findExpert->id,
                'sale_id' => null,
                'name_family' => $user->name . ' ' . $user->family,
                'phone_number' => $user->phone_number,
                'detail' =>   json_encode([
                    'packages' => $request->package
                ]),
                'total_amount' => $packages->totalPrice($packages->getPricePackages($reserve->packages)),
                'status' => 0
            ]);

            $invoice->payments()->create(
                [
                    'amount' => $packages->totalPrice($packages->getPricePackages($reserve->packages)),
                    'payment_type' => 'zarinpal',
                    'details' => null,
                    'transactionId' => '215441564',
                    'status' => 0
                ]
            );

            $payment = new PaymentController();
            $payment->updateInvoiceAmount($invoice);

//            Payment::create();


            $user->notify(new NewExpertAdver($findExpert));

        });


        return [
            'status' => true,
            'data' =>  'عملیات با موفقیت انجام شد.',
        ];

    }

}
