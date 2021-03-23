<?php

namespace App\Repositories\Cache;

use Carbon\Carbon;
use DB;
use Exception;

/**
 * Class Chassis Types.
 */
class ChassiTypeRepository
{
    CONST CACHE_KEY = 'CHASSI_TYPE';

    /**
     * Get all chassis types
     *
     * @return mixed|string
     */
    public  function all()
    {
        $key = "all";
        $cacheKey = $this->getCacheKey($key);
        try {
            return cache()->remember($cacheKey, Carbon::now()->addDay(5), function () {
                return DB::table('chassis_types')->select('id','title','slug')->get();
            });
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * find chassis types title from cache
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
                return DB::table('chassis_types')->select($select)->where('id' , $id)->first();
            });
        } catch (Exception $e) {
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
