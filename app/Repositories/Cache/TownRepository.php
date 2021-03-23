<?php

namespace App\Repositories\Cache;

//use Your Model
use App\User;
use Carbon\Carbon;
use DB;

/**
 * Class Town.
 */
class TownRepository
{
    CONST CACHE_KEY = 'TOWN';

    /**
     * get all towns
     *
     * @return mixed|string
     */
    public  function all()
    {
        $key = "all";
        $cacheKey = $this->getCacheKey($key);
        try {
            return cache()->remember($cacheKey, Carbon::now()->addMinute(5), function () {
                return DB::table('towns')->select('id','title','slug')->get();
            });
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * find town title from cache
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
                return DB::table('towns')->where('state_id',$id)->select('id','title','slug')->get();
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
