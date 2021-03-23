<?php

namespace App\Http\Controllers\PanelAdmin;

use App\Advertising;
use App\Expert;
use App\Invoice;
use App\Sale;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Request;

class DashboardController extends Controller
{
    public function index()
    {
        $adver = new Advertising();
        $countExpertAdver = Expert::verify()->count();
        $countSaleAdver = Sale::verify()->count();
        $saleAdver = Sale::where('status',4)->with('adver')->limit(5)->orderBy('id', 'DESC')->get();
        $expertAdver = Expert::where('status',0)->with('user')->limit(5)->orderBy('id', 'DESC')->get();
        $users = User::orderBy('id', 'DESC')->limit(5)->get();
        $invoices = Invoice::orderBy('id', 'desc')->with('expert')->paginate(5);
        return view('panelAdmin.dashboard',compact('countExpertAdver','countSaleAdver','saleAdver','users','expertAdver','invoices'));

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

}
