<?php

namespace App\Http\Controllers\Api\Adver;

use App\Advertising;
use App\Brand;
use App\Expert;
use App\Http\Controllers\Adver\ExpertAdvController;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models;
use App\User;
use DB;
use Illuminate\Http\Request;

class ExpertController extends BaseController
{

    /**
     * show info for expert advers
     * @return \App\Http\Resources\User\ExpertCollection
     */
    public function index()
    {
        $id = auth()->user()->id;
        $expert = User::find($id)->experts()->orderBy('id', 'desc')->limit(5)->paginate(5);
        return new \App\Http\Resources\User\ExpertCollection($expert);
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function store(Request $request)
    {

        $brand  = Brand::find($request->brand);
        $model = Models::find($request->model);
        if ($brand && $model)
        {
            $request->merge(['title' => $brand->title . ' ' . $model->title]);
        }

        $expert = new ExpertAdvController();
        if ($expert->createADE($request)['status'] == true)
        {
            return $this->sendResponse(null, 'عملیات با موفقیت انجام شد.');
        }
        return $this->sendError($expert->createADE($request)['data']);
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
     * user can view expert adver with id
     *
     * @param Request $request
     * @param $id
     * @return \App\Http\Resources\User\Expert
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Request $request,$id)
    {
        //merge request id for show hidden fields in api
        $request->merge(['id'=>$id]);

        $expert = Expert::find($id);
        $this->authorize('view', $expert);
        if ($expert->status == 0) {
            return $this->sendError('اطلاعات کارشناسی یافت نشد، پس از انجام کارشناسی اطلاعات نمایش داده خواهد شد.');
        }
        return new \App\Http\Resources\User\Expert($expert);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
