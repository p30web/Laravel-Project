<?php

namespace App\Http\Resources;

use Facades\App\Repositories\Cache\ExpertPropertiesRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpertProperties extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $properties = ExpertPropertiesRepository::find($this->id,['health_rating','battery_health','mechanic','paint','electric','safety','wheels','check_document','check_option']);
        return [
            ['title' => 'امتیاز کلی' , 'health_rating' => $properties->health_rating] ,
            ['title' => 'سلامت باتری' ,'battery_health' => json_decode($properties->battery_health , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)],
            ['title' => 'مکانیک خودرو' , 'mechanic' =>  json_decode($properties->mechanic , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)],
            ['title' => 'نقاشی و رنگ', 'paint' => json_decode($properties->paint , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)],
            ['title' => 'سیستم های الکتریکی' ,'electric' => json_decode($properties->electric , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)],
            ['title' => 'سیستم ایمنی' ,'safety' => json_decode($properties->safety , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)],
            ['title' => 'رینگ و تایر' ,'wheels' => json_decode($properties->wheels , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)],
            ['title' => 'بررسی مدارک' ,'check_document' => json_decode($properties->check_document , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)],
            ['title' => 'بررسی آپشن' ,'check_option' => json_decode($properties->check_option , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)]
        ];
    }
}
