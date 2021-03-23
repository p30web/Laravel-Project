<?php


namespace App\Repositories\Cache;


use App\Brand;
use Carbon\Carbon;
use Exception;

class CarStatusRepository
{
    CONST CACHE_KEY = 'CAR_STATUS';

    /**
     * Get all colors
     *
     * @return mixed|string
     */
    public  function all()
    {
        $key = "all";
        $cacheKey = $this->getCacheKey($key);
        try {
            return cache()->remember($cacheKey, Carbon::now()->addDay(5), function () {
                return array(
                    [
                        'id' => 1,
                        'title' => 'کارکرده',
                        'slug' => 'used'
                    ],
                    [
                        'id' => 2,
                        'title' => 'صفر',
                        'slug' => 'new'
                    ] ,
                    [
                        'id' => 3,
                        'title' => 'حواله',
                        'slug' => 'check'
                    ],
                    [
                        'id' => 4,
                        'title' => 'کارتکس',
                        'slug' => 'cartex'
                    ],
                    [
                        'id' => 5,
                        'title' => 'پیش فروش',
                        'slug' => 'presell'
                    ]
                );
            });
        } catch (Exception $e) {
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
    public function find($id, $select)
    {
        $key = "find.{$id}";
        $cacheKey = $this->getCacheKey($key);
        try {
            return cache()->remember($cacheKey, Carbon::now()->addDay(5), function () use ($select,$id) {
                $carStatues = array(
                    [
                        'id' => 1,
                        'title' => 'کارکرده',
                        'slug' => 'used'
                    ],
                    [
                        'id' => 2,
                        'title' => 'صفر',
                        'slug' => 'new'
                    ] ,
                    [
                        'id' => 3,
                        'title' => 'حواله',
                        'slug' => 'check'
                    ],
                    [
                        'id' => 4,
                        'title' => 'کارتکس',
                        'slug' => 'cartex'
                    ],
                    [
                        'id' => 5,
                        'title' => 'پیش فروش',
                        'slug' => 'presell'
                    ]
                );
                foreach($carStatues as $status) {
                    if ($id == $status['id'] ) {
                        $title = $status[$select];
                    }
                }
                return $title;
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