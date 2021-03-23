<?php

namespace App\Http\Controllers\PanelAdmin;

use App\User;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(15);
        return view('User.index',compact('users'));
    }

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $invoices = $user->invoices()->with('expert')->paginate(5);
        $experts = $user->experts()->with('reserve')->paginate(5);
        $advers =$user->advers()->whereHas('sale',function (Builder $query){
            $query;
        })->with('sale')->paginate(5);
        return view('User.edit',compact('user','invoices','experts','advers'));
    }


    private function rules($request,$id)
    {
        $ruleUser = [
            'password' => 'nullable|string|min:8|confirmed',
            'name' => 'nullable|string|max:255',
            'family' => 'nullable|string|max:255',
            'email_panel' => 'nullable|email|max:255|unique:users,email,' . $id,
            'phone_number_panel' => 'bail|required|numeric|unique:users,phone_number,' . $id,
            'code_melli' => 'nullable|numeric|digits:10|unique:users,code_melli,' . $id,
            'adress' => 'nullable|string|max:255',
            'count_fail' => 'numeric|min:0|max:6',
        ];

        return $ruleUser;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //validate requests
        $validator = \Validator::make($request->all(), $this->rules($request,$id));
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->family = $request->family;
        $user->email = $request->email_panel;
        $user->code_melli = $request->code_melli;
        $user->phone_number = $request->phone_number_panel;
        $user->adress = $request->adress;
        $user->phone_token_fails = $request->count_fail;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        return Redirect::route('user.edit',$id)->with('success','کاربر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->advers()->delete();
        $user->invoices()->delete();
        $user->experts()->delete();
        $user->delete();
        return Redirect::back()->with('success','کاربر با موفقیت حذف شد.');
    }
}
