<?php

namespace App\Repositories\Cache;

use Carbon\Carbon;
use DB;

/**
 * Class Production.
 */
class ProductionRepository
{
    CONST CACHE_KEY = 'PRODUCTION';

    /**
     * get all Productions
     *
     * @return mixed|string
     */
    public  function all()
    {
        $key = "all";
        $cacheKey = $this->getCacheKey($key);
        try {
            return cache()->remember($cacheKey, Carbon::now()->addDay(5), function () {
                return DB::table('productions')->select('id','slug')->get();
            });
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


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
            return cache()->remember($cacheKey, Carbon::now()->addDay(5), function () use ($select,$id) {
                return DB::table('productions')->select($select)->where('id' , $id)->first();
            });
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * create cache key
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
