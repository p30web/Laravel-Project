<?php

namespace App\Http\Controllers\PanelAdmin;

use App\Advertising;
use App\Expert;
use App\ExpertProperties;
use App\Http\Resources\Adver;
use App\Notifications\AcceptSaleAdver;
use App\Notifications\CreateExpertProperties;
use App\User;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Validator;

class ExpertPropertiesController extends Controller
{

    public function rules($request)
    {
        $ruleExpertPropertiesAdv = [
            'pdfexpert' => 'mimes:pdf|max:100000',
            'tracking_code' => 'sometimes|required|string|unique:experts,tracking_code,'.$request->id,
            'chassisـnumber' => 'sometimes|required|string',
            'health_rating' => 'sometimes|string',
            'sale_code' => 'sometimes|nullable|numeric',
            'health_status' => 'required|integer',
        ];

        return $ruleExpertPropertiesAdv;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
//        return $request;
        //validate requests
        $validator = Validator::make($request->all(), $this->rules($request));

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $expert = Expert::find($id);

        if (!$expert) {
            return Redirect::back()->withErrors('اگهی کارشناسی یافت نشد.');
        }

        DB::transaction(function() use ($request ,  $expert)
        {
            try {
                if ($request->hasfile('pdfexpert')) {
                    $filenamewithextension = $request->file('pdfexpert')->getClientOriginalName();
                    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                    $extension = $request->file('pdfexpert')->getClientOriginalExtension();
                    $filenametostore = $filename.'_'. $expert->id .'_'.time().'.'.$extension;
                    $path = $request->file('pdfexpert')->storeAs(Carbon::now()->year , $filenametostore , 'file');

                    $expert->download_pdf_link = $path;
                    $expert->status = 1;

                }
            } catch (Exception $e) {
                return Redirect::back()->withErrors('در هنگام آپلود فایل خطایی پیش آمد.');
            };

            if ($request->has('tracking_code')) {
                $expert->tracking_code = $request->tracking_code;
            }

            if ($request->has('health_status')) {
                $expert->health_status_id = $request->health_status;
            }

            if ($request->has('chassisـnumber')) {
                $expert->chassisـnumber = $request->chassisـnumber;
            }
            $expert->update();

            //save properties
            $expert->properties()->updateOrCreate([
                'expert_id' => $expert->id,
            ] , [
                'health_rating' => $request->health_rating,
                'battery_health' => json_encode($request->properties_battery , JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES ),
                'mechanic' => json_encode($request->properties_mechanic , JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
                'paint' => json_encode($request->properties_paint , JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
                'electric' => json_encode($request->properties_electric , JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
                'safety' => json_encode($request->properties_safety , JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
                'wheels' => json_encode($request->properties_wheels , JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
                'check_document' => json_encode($request->properties_check_documents, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
                'check_option' => json_encode($request->properties_check_option, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
            ]);
        });

        //send notify
        if ($request->hasfile('pdfexpert') && $expert->status ==1 ) {
            $user = User::find($expert->user_id);
            $user->notify(new CreateExpertProperties($expert));
        }

        return Redirect::back()->with('success','اطلاعات کارشناسی با موفقیت ثبت شد.');

    }

//
//    private function relationSale($request,$expert)
//    {
//        if ($request->has('sale_code') && !is_null($request->sale_code) ) {
//                try {
//                    $adver = Advertising::where('sale_id', $request->sale_code)->first();
//                    $adver->expert_id = ($request->sale_code != 0 ? $expert->id : null);
//                    if (!$adver)
//                        return Redirect::back()->withErrors('این آی دی آگهی جهت همگام سازی وجود ندارد.');
//                    $adver->save();
//                } catch (Exception $e) {
//                    return Redirect::back()->withErrors('در فرایند ثبت کد آگهی مشکلی پیش آمد :.' . $e->getMessage());
//                }
//            }
//    }

}
