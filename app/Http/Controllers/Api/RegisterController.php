<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\VerifyController;
use App\User;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Validation\Rule;
use Validator;

class RegisterController extends BaseController
{

    protected $typeInputLogin;

    public function __construct($typeInputLogin = '')
    {
        $this->typeInputLogin = $typeInputLogin;
    }

    public function checkInput($request)
    {
        if (isset($request->phone_number) && !isset($request->email) && !isset($request->password)) {
            $this->typeInputLogin = 'phone';
        }
//        else if (isset($request->email) && isset($request->phone_number) && isset($request->password)) {
//            $this->typeInputLogin = 'emailPhonePassword';
//        }
        else if (isset($request->phone_number) && isset($request->password)) {
            $this->typeInputLogin = 'phonePassword';
        }
        else if (isset($request->email) && isset($request->password)) {
            $this->typeInputLogin = 'emailPassword';
        }
    }

    public function registerUser(Request $request)
    {
        $this->checkInput($request);

        //validate fields input
        $validator = Validator::make($request->all(), [
            'email' => [Rule::requiredIf(!$request->phone_number),'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required','regex:/^09[0-9]{9}$/','unique:users'],
            'password' => [Rule::requiredIf($request->email), 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        //create user
        $userId = $this->create($request->all());

        //send sms
        $sms = new VerifyController();
        return $sms->verifyPhone($request->phone_number,$userId);

    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'email' => ($this->typeInputLogin == 'phone' || $this->typeInputLogin == 'phonePassword' ? null : $data['email']) ,
            'password' => ($this->typeInputLogin == 'phone' ? null : Hash::make($data['password'])),
            'phone_number' => ($this->typeInputLogin == 'emailPassword' ? null : $data['phone_number']),
        ])->id;
        return $user;
    }
    
    
}
