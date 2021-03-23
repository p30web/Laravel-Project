<?php


namespace App\Repositories\Cache;


use Carbon\Carbon;
use Exception;

class HealthStatusRepository
{
    CONST CACHE_KEY = 'HEALTH_STATUS';

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
                        'title' => 'بسیار خوب',
                        'slug' => 'verywell'
                    ],
                    [
                        'id' => 2,
                        'title' => 'خوب',
                        'slug' => 'well'
                    ],
                    [
                        'id' => 3,
                        'title' => 'متوسط',
                        'slug' => 'medium'
                    ],
                    [
                        'id' => 4,
                        'title' => 'ضعیف',
                        'slug' => 'poor'
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
                $gearboxStatuses = array(
                    [
                        'id' => 1,
                        'title' => 'بسیار خوب',
                        'slug' => 'verywell'
                    ],
                    [
                        'id' => 2,
                        'title' => 'خوب',
                        'slug' => 'well'
                    ],
                    [
                        'id' => 3,
                        'title' => 'متوسط',
                        'slug' => 'medium'
                    ],
                    [
                        'id' => 4,
                        'title' => 'ضعیف',
                        'slug' => 'poor'
                    ]
                );
                foreach($gearboxStatuses as $status) {
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
