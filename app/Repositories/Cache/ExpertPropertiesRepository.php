<?php


namespace App\Repositories\Cache;


use App\Models;
use App\Properties;
use Carbon\Carbon;

class ExpertPropertiesRepository
{
    CONST CACHE_KEY = 'EXPERTPROPERTIES';

    /**
     * find Color title from cache
     *
     * @param $id
     * @param array $select
     * @return mixed|string
     */
    public function find($id, array $select)
    {
        $key = "find.{$id}";
        $cacheKey = $this->getCacheKey($key);
        try {
            return cache()->remember($cacheKey, Carbon::now()->addSecond(1), function () use ($select,$id) {
                return Properties::where('expert_id', $id)->select($select)->first();
            });
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create cache key
     *
     * @param $key
     * @return string
     */
    public function getCacheKey($key)
    {
        $key = strtoupper($key);
        return self::CACHE_KEY . ".$key";
    }
}