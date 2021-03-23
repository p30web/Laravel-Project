<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Resources\User\invoiceCollection;
use App\Http\Resources\User\invoiceResource;
use App\Http\Resources\UserResource;
use App\Invoice;
use App\User;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = User::find(auth()->user()->id)->invoices()->with('payments')->with('expert')->paginate(5);
        return new invoiceCollection($invoices);
    }

    public function show($id)
    {
        $invoice = Invoice::where('user_id',auth()->user()->id)->where('id',$id)->with('payments')->with('expert')->first();
        $this->authorize('view', $invoice);
        return new invoiceResource($invoice);
    }

}
