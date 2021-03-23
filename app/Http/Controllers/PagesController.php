<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Sms\SmsController;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Response;

class PagesController extends Controller
{



    /**
     * Show index site.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }
}
