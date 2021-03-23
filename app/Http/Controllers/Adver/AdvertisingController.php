<?php

namespace App\Http\Controllers\Adver;

use App\Advertising;
use App\Brand;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\AdvertisingRequest;
use App\Models;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Validator;

class AdvertisingController extends BaseController
{


    /**
     * list rules for check field input
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:2|max:32',
            'slug' => 'string|min:2|max:32',
            'brand' => 'required|integer',
            'model' => 'required|integer',
        ];
    }


    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->rules());
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

    return true;
    }


}
