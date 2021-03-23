<?php

namespace App\Http\Controllers\Api;

use Facades\App\Repositories\Cache\PackageRepository;

class PackageController extends BaseController
{

    public function getPackageById($locationId)
    {
        $package= new \App\Http\Controllers\PackageController($locationId);

        if (!$package->getPackageByLocation())
            return $this->sendError('مکان مورد نظر یافت نشد.');

        return $this->sendResponse($package->getPackageByLocation());

    }

    public function getPricePackages($packagesId)
    {
        $package= new \App\Http\Controllers\PackageController();
        if (!$package->getPricePackages($packagesId))
            return $this->sendError('مکان مورد نظر یافت نشد.');

        return $this->sendResponse($package->getPricePackages($packagesId));

    }
}
