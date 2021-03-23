<?php

namespace App\Http\Controllers\Filter;

use App\Advertising;
use App\Filters\AdvertisingFilter;
use App\Http\Controllers\Adver\AdvertisingController;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Reserve\ReserveController;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdverCollection;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Kyslik\LaravelFilterable\Exceptions\InvalidArgumentException;
use Validator;

class AdverFilterController extends BaseController
{

    /**
     *  check advertising for existence sale & expert so show result filter
     *
     * @param Advertising $adver
     * @param AdvertisingFilter $filters
     * @return AdverCollection|Response
     */
    public function index(Advertising $adver , AdvertisingFilter $filters, Request $request)
    {
        $adverCustom = $adver->whereHas('sale', function (Builder $query) {
            $query->verify();
        })->orderBy('id', 'desc');

        try {
            return new AdverCollection($adverCustom->filter($filters)->paginate((int) $request->limit));
        } catch (Exception $e) {
            return $this->sendError('یافت نشد ...');
        }
    }

}
