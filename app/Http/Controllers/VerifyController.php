<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\VerifyPhoneController;
use Config;

class VerifyController extends BaseController
{

    /**
     * VerifyController constructor.
     */
    public function __construct()
    {
        $this->middleware('client');
    }

    /**
     * check throttle request
     * generate random number
     * save to db
     * send response
     *
     * @param $phoneNumber
     * @param $userId
     * @return \Illuminate\Http\Response
     */
    public function verifyPhone($phoneNumber, $userId)
    {
        
        $verifyPhone = new VerifyPhoneController();

        if ($verifyPhone->randomNumber($phoneNumber,$userId)) {
            return $this->sendResponse([
                'phone_number' => $phoneNumber,
                'expire_date' => round(microtime(true) * 1000),
                'allow_resend' => round(microtime(true) * 1000)+60000
            ],'پیام با موفقیت ارسال شد.')->withCookie(cookie('expire_date', '1', 1));
        }

       return  $this->sendError('تعداد دفعات مجاز برای ارسال درخواست پیامک '. Config::get('constants.options.NUMBER_SEND_VERIFICATION') .' عدد می باشد. لطفا با بخش پشتیبانی تماس بگیرید.');

    }


}
