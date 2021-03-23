<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\VerifyController;
use App\User;
use Auth;
use DB;
use Hash;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;

class LoginController extends BaseController
{
    protected $typeInputLogin;

    public function __construct($typeInputLogin = '')
    {
        $this->typeInputLogin = $typeInputLogin;
        $this->middleware('guest');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * list rules for check field input
     * @return array
     */
    public function rules()
    {
        return [
            'inputLogin' => 'bail|required' .
            ($this->typeInputLogin == 'email' ? '|email' : ''),
            ($this->typeInputLogin == 'phone' ? '|regex:/^09[0-9]{9}$/|integer|digits:11' : ''),
            'expire_time' => 'numeric',
            'password' => 'string',
            'remember_me' => 'boolean'
        ];
    }


    /**
     * set messages for validate input
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'لطفا ایمیل و یا شماره تلفن همراه خود را وارد نمایید.',
            'email' => 'آدرس ایمیل معتبر نمی باشد.',
        ];
    }


    /**
     * check Type input
     *
     * @param $request
     */
    public function checkInput($request)
    {
        if (preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $request)) {
            $this->typeInputLogin = 'email';
        } else if (preg_match("/^09[0-9]{9}$/", $request)) {
            $this->typeInputLogin = 'phone';
        }
    }


    /**
     *  method check type and login user
     *
     * @param Request $LoginRequest
     * @return \Illuminate\Http\Response|mixed|string
     */
    public function login(Request $LoginRequest)
    {
        $this->checkInput($LoginRequest->inputLogin);

        $validator = \Validator::make($LoginRequest->all(), $this->rules(), $this->messages());
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if ($this->typeInputLogin == null) {
            return $this->sendError('مقدار وارد شده صحیح نمی باشد.');
        }

        switch ($this->typeInputLogin) {
            case 'phone':
                if (!$LoginRequest->password)
                    return $this->loginWithPhoneSMS($LoginRequest);
                return $this->loginWithPhonePassword($LoginRequest);
                break;
            case 'email':
                return $this->loginWithEmail($LoginRequest);
                break;
        }


    }

    /**
     * Login with phone number
     *
     * @param $request
     * @return mixed
     */
    public function loginWithPhoneSMS($request)
    {
        try {
            //check user  exist
            $auth = new AuthenticationController();
            if (!$user = $auth->checkUserExistJustPhone($request->inputLogin))
            {
                $user =  User::create([
                    'phone_number' => $request->inputLogin,
                ]);
            }

            //check throttle user
            //expire_time = allow_resend callback
            if ($request->cookie('expire_date') == 1 && $request->has('expire_time') && $request->expire_time > round(microtime(true) * 1000)) {
                return $this->sendError('امکان درخواست مکرر وجود ندارد.');
            }

            //send sms code - verify
            $verifyMobile = new VerifyController();
            return $verifyMobile->verifyPhone($request->inputLogin,  $user->id, $request->expire_time);

        } catch(QueryException $ex){
            return $this->sendError($ex->getMessage());
        }

    }


    /**
     * Login with phone & password
     * @param $request
     * @return \Illuminate\Http\Response|string
     */
    public function loginWithPhonePassword($request)
    {

        //check user  exist
        $credentials = [
            'phone_number' => $request->inputLogin,
            'password' => $request->password,
        ];
        $auth = new AuthenticationController();
        if (!$auth->checkUserExist($credentials))
            return $this->sendError('شماره موبایل و یا رمز عبور صحیح نمی باشد.');

        if (!$auth->checkUserPhoneToken($credentials))
            return $this->sendError('لطفا ابتدا شماره تلفن همراه خود را تایید نمایید.');

        //create token for Login with phone & password
        $user = $request->user();
        return $auth->authentication($user);

    }


    /**
     * Login with email & password
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function loginWithEmail($request)
    {

        //check user exist
        $credentials = [
            'email' => $request->inputLogin,
            'password' => $request->password,
        ];
        $auth = new AuthenticationController();
        if (!$auth->checkUserExist($credentials))
            return $this->sendError('آدرس ایمیل و یا رمز عبور صحیح نمی باشد.');

        //create token for login with Email
        $user = $request->user();
        return $auth->authentication($user);

    }

}
