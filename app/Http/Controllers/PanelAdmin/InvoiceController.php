<?php

namespace App\Http\Controllers\PanelAdmin;

use App\Expert;
use App\Invoice;
use App\Reserve;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends PaymentController
{

    protected $status;

    public function __construct($status = 1, $payments = null)
    {
        $this->status = $status;
        $this->payments =  $payments;
    }

    /**
     * Display a listing of the invoices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->with('expert')->paginate(5);
        return view('Invoice.index',compact('invoices'));
    }


    public function edit($id)
    {
        $invoice = Invoice::where('id',$id)->with('user')->with('payments')->first();
        $expert = Expert::where('id',$invoice->expert->id)->with('reserve')->first();
        $packages = Reserve::find($expert->reserve->id)->packages;
        $reserve =  json_decode($expert->reserve->reserveDate , true);
        $payment = new PaymentController($invoice->payments);
        $sumUnAmountPaid = number_format($payment->sumAmountUnPaid(),0);;
        return view('Invoice.edit',compact('invoice','expert','reserve','payment','sumUnAmountPaid','packages'));
    }


}
