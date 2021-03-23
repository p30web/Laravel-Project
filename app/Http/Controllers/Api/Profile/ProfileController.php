<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Facades\App\Repositories\Cache\UserRepository;
use App\User;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Redirect;

class ProfileController extends BaseController
{

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
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return UserResource
     */
    public function show()
    {
        $id = auth()->user()->id;
        $user = UserRepository::get($id);
        return new UserResource($user);
    }

    private function rules($request)
    {
        $ruleUser = [
            'password' => 'nullable|string|min:8|confirmed',
            'old_password' =>  Rule::requiredIf(!empty(auth()->user()->password)).'|string|min:8',
            'name' => 'nullable|string|max:255',
            'family' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . auth()->user()->id,
            'code_melli' => 'nullable|numeric|digits:10|unique:users,code_melli,' . auth()->user()->id,
            'adress' => 'nullable|string|max:255',
        ];

        return $ruleUser;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        //validate requests
        $validator = \Validator::make($request->all(), $this->rules($request));
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $user = User::find(auth()->user()->id);

        if (isset($request->old_password) && !empty(auth()->user()->password) && !Hash::check($request->old_password, $user->password)) {
            return $this->sendError('پسورد وارد شده با پسورد قبلی شما مطابقت ندارد.');
        }

        if (isset($request->password)) {
            $user->password = Hash::make($request->password);

            $user->save();

        } else {
            if (empty($user->email)) {
                $user->email = $request->email;
            }
            if (empty($user->code_melli)) {
                $user->code_melli = $request->code_melli;
            }

            $user->name = $request->name;
            $user->family = $request->family;
            $user->adress = $request->adress;

            $user->save();
        }

        return $this->sendResponse(null,'پروفایل با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
