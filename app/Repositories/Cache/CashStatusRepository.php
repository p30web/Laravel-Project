<?php


namespace App\Repositories\Cache;


use App\Brand;
use Carbon\Carbon;
use Exception;

class CashStatusRepository
{
    CONST CACHE_KEY = 'CASH';

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
                        'title' => 'نقد',
                        'slug' => 'naghd'
                    ],
                    [
                        'id' => 2,
                        'title' => 'لیزینگ',
                        'slug' => 'leasing'
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
                $cashes = array(
                    [
                        'id' => 1,
                        'title' => 'نقد',
                        'slug' => 'naghd'
                    ],
                    [
                        'id' => 2,
                        'title' => 'لیزینگ',
                        'slug' => 'leasing'
                    ]
                );
                foreach($cashes as $cash) {
                    if ($id == $cash['id'] ) {
                        $title = $cash[$select];
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