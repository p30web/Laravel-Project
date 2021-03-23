<?php

namespace App\Http\Resources;

use App\Http\Controllers\Api\ApiController;
use Carbon\Carbon;
use Facades\App\Repositories\Cache\CarStatusRepository;
use Facades\App\Repositories\Cache\CashStatusRepository;
use Facades\App\Repositories\Cache\ChassiTypeRepository;
use Facades\App\Repositories\Cache\DifferentialRepository;
use Facades\App\Repositories\Cache\GearboxStatusRepository;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Sale extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $flag = ($request->has('id') ? true : false);
        $element = new ApiController();
        return [
            'color' => $element->getTitleColorById($this->color_id),
            'price' => $this->price,
            'production' => $element->getProductionById($this->production_id),
            'bodystatus' => $element->getTitleBodiesStatusById($this->bodystatus_id),
            'placestain_id' => $this->placestain_id,
            'amortization' => $this->amortization,

            'inplace' => $this->in_place,
            'cash' => $this->when($flag, CashStatusRepository::find($this->cash , 'title')) ,
            'chassitype' => $this->when($flag, ChassiTypeRepository::find($this->chassi_type , ['title'])->title),
            'gearboxstatus' => $this->when($flag , GearboxStatusRepository::find($this->girbox, 'title')),
            'carstatus' => $this->when($flag , CarStatusRepository::find($this->car_status,'title')),
            'differential' => $this->when($flag, DifferentialRepository::find($this->differential,'title')),

            'city' => $element->getTitleCityById($this->city_id),
            'town' => $element->getTitleTownById($this->town_id),
            'description' => $this->description,
            'date' =>  Verta::parse($this->created_at)->formatDifference(),
            'status' => $this->status,
        ];
    }
}
