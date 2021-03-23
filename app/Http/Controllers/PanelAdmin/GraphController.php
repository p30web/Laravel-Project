<?php

namespace App\Http\Controllers\PanelAdmin;

use App\Advertising;
use App\Sale;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;

class GraphController extends Controller
{

    //https://stackoverflow.com/questions/40888168/use-laravel-collection-to-get-duplicate-values

    public function getAdversByGroupBrands()
    {
        //get 7 month ago

        $adverisings = Advertising::all()->groupBy('brand_id');
        return $adverisings->map(function ($items) {
            return $items;
        });
    }

//    public function seprate

    public function getBrandChart()
    {
        $days = Input::get('days', 7);

        $range = Carbon::now()->subDays($days);

        $stats = Sale::where('created_at', '>=', $range)
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->get([
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as value')
            ])
            ->toJSON();

        return $stats;
    }
}
