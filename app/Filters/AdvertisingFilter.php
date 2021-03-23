<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Kyslik\LaravelFilterable\Exceptions\InvalidSettingsException;
use Kyslik\LaravelFilterable\Generic\Filter;

class AdvertisingFilter extends Filter
{

    //best practice => brand_id[0]=5&brand_id[1]=6&model_id[0]=1 &....

    /**
     * Defines columns that end-user may filter by.
     *
     * @var array
     */
    protected $filterables = ['brand_id', 'model_id','id'];


    /**
     * filter
     * @return array
     */
    public function filterMap(): array
    {

        // validate request and clean request
        $this->request->validate([
            'city_id' => 'integer',
            'placestain_id' => 'integer',
//            'production_id' => 'regex:/^\d(?:,\d)*$/',
            'brand_id' => 'integer',
            'model_id' => 'integer',
            'color_id' => 'integer',
            'id' => 'integer',
//            'in_place' => 'in:true,false',
            'cash' => 'integer|between:1,2',
            'chassis_type' => 'integer|between:1,6',
            'girbox' => 'integer|between:1,2',
            'car_status' => 'integer|between:1,5',
            'differential' => 'integer|between:1,3',
        ]);


        //connecting functions to parameters
        return [
            'adverSaleCity' => ['city_id'],
            'adverSaleBodyStatus' => ['placestain_id'],
            'adverSaleProduction' => ['production_id'],
            'adverSaleChassisType' => ['chassi_type'],
            'adverSaleGearBoxStatus' => ['girbox'],
            'adverSaleCarStatus' => ['car_status'],
            'adverSaleInPlace' => ['in_place'],
            'adverSaleCash' => ['cash'],
            'adverSaleDifferential' => ['differential'],
            'adverSaleColor' => ['color_id'],
            'adverSale' => ['sale'],
            'adverExpert' => ['expert'],
        ];
    }
    /**
     * filter with city
     *
     * @param null $city_id
     * @return Builder
     */
    public function adverSale()
    {
        return $this->builder->doesntHave('expert')->whereHas('sale', function (Builder $query) {
            $query->verify()->orderBy('id', 'desc');
        });
    }

    /**
     * @return array
     */
    protected function fields(): array
    {
        return array_filter(
            array_map('trim', $this->request->all())
        );
    }

    /**
     * filter with city
     *
     * @param null $city_id
     * @return Builder
     */
    public function adverExpert()
    {
        return $this->builder->whereHas('sale', function (Builder $query) {
            $query->verify();
        })->whereHas('expert', function (Builder $query) {
            $query->verify()->orderBy('id', 'desc');
        });
    }

    /**
     * filter advereds by Production
     *
     * @param null $start
     * @return Builder
     */
    public function adverSaleProduction($start = null)
    {

        return $this->builder->whereHas('sale', function (Builder $query) use ($start) {
            //explode request
            //if smallerthan 2 , end 999999 -> for get all productiones ..
            //else array slice and show between productiones
            $array = explode(',', $start);
            if (count($array) < 2) {
                array_push($array, 999999);
            } else if (count($array) > 2) {
                $array = array_slice($array, 0, 2);
            }
            $query->whereBetween('production_id', $array);
        });
    }

    /**
     * filter with city
     *
     * @param null $city_id
     * @return Builder
     */
    public function adverSaleCity($city_id = null)
    {
        return $this->builder->whereHas('sale', function (Builder $query) use ($city_id) {
            $query->where('city_id', '=', $city_id)->orderBy('id', 'desc');
        });
    }

    /**
     * filter with chassi type
     *
     * @param null $chassi_type
     * @return Builder
     */
    public function adverSaleChassisType($chassi_type = null)
    {
        return $this->builder->whereHas('sale', function (Builder $query) use ($chassi_type) {
            $query->where('chassi_type', '=', $chassi_type)->orderBy('id', 'desc');
        });
    }

    /**
     * filter with gearbox status
     *
     * @param null $gearbox_status
     * @return Builder
     */
    public function adverSaleGearBoxStatus($gearbox_status = null)
    {
        return $this->builder->whereHas('sale', function (Builder $query) use ($gearbox_status) {
            $query->where('girbox', '=', $gearbox_status)->orderBy('id', 'desc');
        });
    }


    /**
     * filter with car status
     *
     * @param null $car_status
     * @return Builder
     */
    public function adverSaleCarStatus($car_status = null)
    {
        return $this->builder->whereHas('sale', function (Builder $query) use ($car_status) {
            $query->where('car_status', '=', $car_status)->orderBy('id', 'desc');
        });
    }


    /**
     * filter with in place
     *
     * @param null $in_place
     * @return Builder
     */
    public function adverSaleInPlace($in_place = null)
    {
        return $this->builder->whereHas('sale', function (Builder $query) use ($in_place) {
            $query->where('in_place', '=', $in_place)->orderBy('id', 'desc');
        });
    }


    /**
     * filter with cash
     *
     * @param null $cash
     * @return Builder
     */
    public function adverSaleCash($cash = null)
    {
        return $this->builder->whereHas('sale', function (Builder $query) use ($cash) {
            $query->where('cash', '=', $cash)->orderBy('id', 'desc');
        });
    }


    /**
     * filter with differential
     *
     * @param null $differential
     * @return Builder
     */
    public function adverSaleDifferential($differential = null)
    {
        return $this->builder->whereHas('sale', function (Builder $query) use ($differential) {
            $query->where('differential', '=', $differential)->orderBy('id', 'desc');
        });
    }

    /**
     * filter with cash
     *
     * @param null $color
     * @return Builder
     */
    public function adverSaleColor($color = null)
    {
        return $this->builder->whereHas('sale', function (Builder $query) use ($color) {
            $query->where('color_id', '=', $color)->orderBy('id', 'desc');
        });
    }

    /**
     * filter with body status
     *
     * @param null $placestain_id
     * @return Builder
     */
    public function adverSaleBodyStatus($placestain_id = null)
    {
        return $this->builder->whereHas('sale', function (Builder $query) use ($placestain_id) {
            $query->whereJsonContains('placestain_id', $placestain_id)->orderBy('id', 'desc');
        });
    }

    /**
     * Define allowed generics, and for which fields.
     * Read more in the documentation https://github.com/Kyslik/laravel-filterable#additional-configuration
     *
     * @return void
     * @throws InvalidSettingsException
     */
    protected function settings()
    {
        $this->only(['=', '><']);
    }
}
