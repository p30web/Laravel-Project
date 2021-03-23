<?php

namespace App\Http\Controllers\PanelAdmin;

use App\Brand;
use App\Expert;
use App\Models;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ExpertSearchController extends Controller
{
    public function search(Request $request)
    {

        $date = $request->date;
        $expert_status = $request->expert_status;

        $brands = Brand::all();
        $models = Models::all();

        $Status_array = array(
            "11" => "همه",
            "0" => "کارشناسی نشده",
            "1" => "کارشناسی شده"
        );

        if($expert_status == 11 && $request->date == null) {
            $experts = DB::table('experts')
                ->join('users', 'users.id', '=', 'experts.user_id')
                ->leftJoin('expert_reserves', 'expert_id', '=', 'experts.id')
                ->get();
        }


        if ($expert_status != 11 && $request->date == null){
            $experts = DB::table('experts')
                ->join('users', 'users.id', '=', 'experts.user_id')
                ->leftJoin('expert_reserves', 'expert_id', '=', 'experts.id')
                ->where('status', $expert_status)
                ->get();
        }

        if($expert_status == 11 && $request->date != null) {
            $experts = DB::table('experts')
                ->join('users', 'users.id', '=', 'experts.user_id')
                ->leftJoin('expert_reserves', 'expert_id', '=', 'experts.id')
                ->whereJsonContains('reserveDate->date', $date)
                ->get();
        }

        elseif ($expert_status != 11 && $request->date != null){
            $experts = DB::table('experts')
                ->join('users', 'users.id', '=', 'experts.user_id')
                ->leftJoin('expert_reserves', 'expert_id', '=', 'experts.id')
                ->where('status', $expert_status)
                ->whereJsonContains('reserveDate->date', $date)
                ->get();
        }

//        $experts = DB::table('experts')
//            ->join('users', 'users.id', '=', 'experts.user_id')
//            ->leftJoin('expert_reserves', 'expert_id', '=', 'experts.id')
//            ->where('status', $expert_status)
//            ->get();

//        $experts->where('status', $expert_status)->get();

        return view('ExpertAdver.filter',compact('experts','date','expert_status','Status_array','brands','models'));

        return $experts;
    }
}
