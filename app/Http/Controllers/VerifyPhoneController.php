<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Notifications\NewSaleAdver;
use App\Notifications\VerifyPhoneUser;
use App\User;
use Auth;
use Config;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ipecompany\Smsirlaravel\Smsirlaravel;
use Session;

class VerifyPhoneController extends BaseController
{

    /**
     *check and verify code sms code
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
            //check rules and validate verifyCode
            $rules = [
                'verifyPhone_code' => 'required|numeric',
                'phone_number' => 'required|regex:/^09[0-9]{9}$/|numeric',
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            //first check phone number
            //check count fails
            //check verification code
            //update token fails with new variable
            $user = User::where('phone_number',$request->phone_number)->first();
            if (!$user){
                return $this->sendError(['کاربر یافت نشد !']);
            }  else if ($user->phone_token_fails > 5) {
                return $this->sendError(['تعداد دفعات مجاز برای وارد کردن کد حداکثر 5 مرتبه می باشد. لطفا روی گزینه ارسال کد تاییدیه کلیک نمایید.']);
            } else if ($user->phone_token != $request->verifyPhone_code) {
                $userFails = $user->phone_token_fails;
                $userFails++;
                $user->update(['phone_token_fails' => $userFails]);
                return $this->sendError(['کد ارسالی نامعتبر می باشد.']);
            }

            //if true up verificationupdate token
            $user->update(['phone_token' => null]);

            //create authinticate login with phone
            $auth = new AuthenticationController();
            return $auth->authentication($user);

    }

    /**
     * generate random number for verificition sms and send sms code
     *
     * @param $phoneNumber
     * @param $userid
     * @return bool
     */
    public function randomNumber($phoneNumber,$userid)
    {
        DB::transaction(function () use ($phoneNumber, $userid) {

            $user = User::findOrFail($userid);

            $rand_no = rand(1000, 9999);
            $stack = (Array) array_map('intval', str_split($rand_no));
            array_push($stack, 1);
            $rand_no = implode("",$stack);

            if ($user->phone_token != null) {
                array_pop($stack);
                $getToken = (Array) array_map('intval', str_split($user->phone_token));
                $endNumber = end($getToken);
                if($endNumber >= Config::get('constants.options.NUMBER_SEND_VERIFICATION')) { return false;}
                $endNumber++;
                array_pop($getToken);
                array_push($stack,$endNumber);
                $rand_no = implode("",$stack);
            }

            $user->phone_token  = $rand_no;
            $user->save();

            $user->notify(new VerifyPhoneUser($user));
        });

        return true;
   }
   
}
