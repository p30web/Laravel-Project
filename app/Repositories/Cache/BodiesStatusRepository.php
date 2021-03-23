<?php

namespace App\Repositories\Cache;
use Carbon\Carbon;
use DB;

/**
 * Class Body Status.
 */
class BodiesStatusRepository
{
    CONST CACHE_KEY = 'BODYSTATUS';

    /**
     * get all body statues
     *
     * @return mixed|string
     */
    public  function all()
    {
//        \Cache::forget('BODYSTATUS.ALL');
        $key = "all";
        $cacheKey = $this->getCacheKey($key);
        try {
            return cache()->remember($cacheKey, Carbon::now()->addDay(5), function () {
                return DB::table('bodystatus')->select('id','title','slug')->get();
            });
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * find body status title from cache
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
                return DB::table('bodystatus')->select($select)->where('id' , $id)->first();
            });
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     *  create cache key
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
