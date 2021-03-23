<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Location;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;

class LocationController extends BaseController
{

    /**
     * @return \Illuminate\Http\Response
     */
    public function getLocations()
    {
        $locations = Location::select('place','slug','id')->get();
        return $this->sendResponse($locations);
    }

    public function getLocationById($id)
    {
        $location = Location::find($id);
        return ($location ? $location : $this->sendError('لوکیشن مورد نظر یافت نشد.'));
    }

}
