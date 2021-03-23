<?php

namespace App\Http\Controllers\Api\Reserve;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Api\LocationController;
use App\Location;
use App\Reserve;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;

class ReserveController extends BaseController
{
    private $location;
    private $dateNow;

    public function __construct($location = null , $dateNow = null)
    {
        $this->location = $location;
        $this->dateNow = $dateNow;
    }

    /**
     * check date
     *
     * @param $locationId
     * @param $date
     * @return bool|\Illuminate\Http\Response
     */
    public function checkDate($date)
    {
        $date = $this->strReplaceDate($date,'-','/');
        //check in array
        if (in_array($date , $this->getDatesById($this->location , null))) {
            $date = $this->strReplaceDate($date,'-','/');

            return $this->getTimesByLocationId($this->location,$date);
        }
        return false;
    }

    /**
     * replace date with custom elements
     *
     * @param $date
     * @param $search
     * @param $replace
     * @return mixed
     */
    private function strReplaceDate($date,$search,$replace)
    {
        return str_replace($search,$replace,$date);
    }

    /**
     * get count reserve by date and time
     *
     * @param $date
     * @param $time
     * @return int
     */
    public function getCountsTimeForReserve($date,$time)
    {
        $date = $this->strReplaceDate($date,'-','/');

        $reserves = DB::table('expert_reserves')
            ->where('reserveDate->date', $date)
            ->where('reserveDate->time', $time)
            ->get();
        return $reserves->count();
    }


    /**
     * @param $locationId
     * @param null $date
     * @return array|\Illuminate\Http\Response|int|string
     */
    public function getDatesById($locationId, $date = null)
    {
        $this->location = $locationId;
        $this->dateNow = Carbon::now()->format('Y/m/d');

        if (isset($date))
        {
            if (!$this->checkDate($date))
                return $this->sendError('تاریخ نامعتبر است.');

            return $this->checkDate($date);
        }

        try {
            $dates = $this->getDatesFromRange($this->dateNow, Carbon::now()->add(7, 'day')->format('Y/m/d') , $this->location);
            return $dates;
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * get times by Location
     *
     * @param $locationId
     * @param null $date
     * @return \Illuminate\Http\Response
     */
    public function getTimesByLocationId($id , $date = null)
    {

//        return $this->getCountsTimeForReserve($date,'19:00:00');

        $timeReserves  = DB::table('expert_times')->select('id','time','location_id','limit')->where('location_id',$id)->get();
        //fillter time this
        $timesCanReserve = $this->getTimesFromRange(Carbon::now()->format('H:i:s'), $timeReserves);

        if ($timeReserves->count() > 0 )
        {
            $items = array();
            foreach ($timeReserves as $timeReserve)
            {
                $items[] = [
                    'id' => $timeReserve->id ,
                    'time' => $timeReserve->time ,
                    'limit' => ( ($timeReserve->limit) > $this->getCountsTimeForReserve($date,$timeReserve->time) ? true : false),
                    //if date  isn't null and isn't now & counts time of this date < 3 == true , else false
                    'status' => ($date == null || Verta::instance($this->dateNow)->format('Y/m/d') != $date || in_array( $timeReserve->time ,$timesCanReserve) ? true : false),
                ];
            }
            return $this->sendResponse($items) ;
        }
        return $this->sendError('تایمی برای این مکان ست نشده است.');
    }

    public function getNonReserveDate($locationId)
    {
        $nonreserve  = DB::table('nonreserves')->select('id','date','description')->where('location_id',$locationId)->get();
        return $nonreserve->toArray() ;
    }

    private function getDatesFromRange($date_time_from, $date_time_to , $id)
    {

        //check location
        $location = Location::find($id);
        if (!$location)
            return $this->sendError('مکان مورد نظر یافت نشد.');

        $period = CarbonPeriod::between($date_time_from , $date_time_to);

        $weekendFilter = function ($date)  {
            return $date->dayOfWeek !== Carbon::FRIDAY ;
        };

        $nonReserveFilter = function ($date) use ($id) {
                if ($this->getNonReserveDate($id) )
                {
                    $shmasi = $date->shamsi();
                    foreach ($this->getNonReserveDate($id) as $nreserve)
                    {
                        if ($shmasi->format('Y/m/d') == $nreserve->date)
                            $date = null;
                    }
                }
                return $date ;
        };

        $filterFriday = $period->filter($weekendFilter);
        $filterFriday->filter($nonReserveFilter);

        $days = [];
        foreach ($period as $date) {
            $days[] =  $date->shamsi()->format('Y/m/d');
        }

        return $days;
    }

    private function getTimesFromRange($date_time_from, $timeReserves)
    {
        $time = array();
        foreach ($timeReserves as $timeReserve)
        {
            $hour = explode (":", $timeReserve->time);
            $nowHour = explode (":", $date_time_from);
            if ($hour[0] > $nowHour[0]) {
                $time[] = $timeReserve->time;
            }
        }
        //saat haye faal baraye sabte sefaresh ra neshan midahad - time jari
        return $time;

        //badesh bayad check beshe hadeaksar on saat 3 nafar reserve kardan

    }

}
