<?php

namespace App\Repositories\Cache;

//use Your Model
use App\User;
use Carbon\Carbon;

/**
 * Class User.
 */
class UserRepository
{
    CONST CACHE_KEY = 'USER';

    /**
     * get all users
     *
     * @return mixed|string
     */
    public function all()
    {
        $key = "all";
        $cacheKey = $this->getCacheKey($key);
        try {
            return cache()->remember($cacheKey, Carbon::now()->addMinute(5), function () {
                return User::get();
            });
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * get user by id  from cache
     *
     * @param $id
     * @return mixed|string
     */
    public function get($id)
    {
        $key = "get.{$id}";
        $cacheKey = $this->getCacheKey($key);
        try {
            return User::find($id);
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
