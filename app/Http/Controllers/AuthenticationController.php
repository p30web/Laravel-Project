<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Hash;
//use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController as BaseController;

class AuthenticationController extends BaseController
{

    /**
     * check user exist . def =  false;
     * @param $credentials
     * @return bool
     */
    public function checkUserExist($credentials)
    {
        if (Auth::attempt($credentials))
            return true;
        return false;
    }

    /**
     * check user exist Just phone . def =  false;
     * @param $credentials
     * @return bool
     */
    public function checkUserExistJustPhone($credentials)
    {
        $user = DB::table('users')
            ->where('phone_number', $credentials)
            ->first();

        if ($user)
            return $user;
        return false;
    }

    public function checkUserPhoneToken($credentials)
    {
        $user = User::where('phone_number',$credentials['phone_number'])->first();
        if (!$user->phone_token)
            return true;
        return false;
    }


    /**
     * Create token for user
     * @param $request
     * @param $typeLogin
     * @return \Illuminate\Http\Response
     */
    public function authentication($user, $typeLogin = null)
    {

        Auth::login(User::find($user->id));

        if (auth()->check()) {
            $tokenResult = $user->createToken('password-for-user-' . auth()->id());
            $token = $tokenResult->token;

            //you can change this expire
//        if ($request->remember_me)
//            $token->expires_at = Carbon::now()->addWeeks(1);

            $token->save();

            $response = [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ];


            //reset phone_token_fails user
            $user->phone_token_fails = 0;
            $user->ip_adress = request()->ip();
            $user->update();

            return $this->sendResponse($response, 'احراز هویت کاربر با موفقیت انجام شد.');
        }
        return $this->sendError('احراز هویت انجام نشده است.');
    }




    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
//    public function login(Request $request)
//    {
////        return $this->checkInput($request);
//        $request->validate([
//            'email' => 'required|string|email',
//            'password' => 'required|string',
//            'remember_me' => 'boolean'
//        ]);
//        $credentials = request(['email', 'password']);
//        if(!Auth::attempt($credentials))
//            return response()->json([
//                'message' => 'Unauthorized'
//            ], 401);
//        $user = $request->user();
//        $tokenResult = $user->createToken('Personal Access Token');
//        $token = $tokenResult->token;
//        if ($request->remember_me)
//            $token->expires_at = Carbon::now()->addWeeks(1);
//        $token->save();
//        return response()->json([
//            'access_token' => $tokenResult->accessToken,
//            'token_type' => 'Bearer',
//            'expires_at' => Carbon::parse(
//                $tokenResult->token->expires_at
//            )->toDateTimeString()
//        ]);
//    }


    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
//    public function logout(Request $request)
//    {
//        $request->user()->token()->revoke();
//        return response()->json([
//            'message' => 'Successfully logged out'
//        ]);
//    }
//
//
//    public function login(Request $request)
//    {
//        $user = User::where('email',$request->email)->first();
//
//        if ($user) {
//            if (Hash::check($request->password,$user->password)) {
//                $token = $user->createToken('Laravel Grant Folan')->accessToken;
//                $response = ['token'=>$token];
//                return response($response , 200);
//            } else {
//                $response = 'password not matched ';
//                return response($response , 422);
//            }
//        } else {
//            $response = 'user net exist ! ';
//            return response($response , 422);
//        }
//    }
}
