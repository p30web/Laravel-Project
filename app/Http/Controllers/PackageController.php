<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Location;

class PackageController extends BaseController
{
    public $location;

    /**
     * PackageController constructor.
     * @param null $location
     */
    public function __construct($location = null)
    {
        $this->location = $location;
    }

    public function getPackageByLocation()
    {
        $location = Location::find($this->location);
        if (!$location)
            return false;

        return $location->packages;
    }


    public function getPricePackages($packages)
    {

        $price = array();
        if (!isset($packages))
            foreach ($this->getPackageByLocation() as $package) {
                $price[] = $package->price;
            }

        foreach ($packages as $package) {
            $price[] = $package->price;
        }

        return $price;

    }


//    public function getTitlePackages($packages)
//    {
//        $title = array();
//        if (!isset($packages))
//            foreach ($this->getPackageByLocation() as $package) {
//                $title[] = $package->title;
//            }
//
//        foreach ($packages as $package) {
//            $title[] = $package->title;
//        }
//
//        return $title;
//
//    }


    public function totalPrice(array  $prices)
    {
        return array_sum($prices);
    }

}
