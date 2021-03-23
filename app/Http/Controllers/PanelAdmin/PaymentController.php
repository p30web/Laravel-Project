<?php

namespace App\Http\Controllers\PanelAdmin;

use App\Invoice;
use App\Payment;
use Config;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class PaymentController extends Controller
{
    public $payments;
    public $totalAmount;
    const TAX = 9;

    public function __construct($payments = null)
    {
        $this->payments = $payments;
    }

    /**
     * check paid payment
     *
     * @param $payment (foreach)
     * @return bool
     */
    private function paid($payment)
    {
        return ($payment->status == 1 ? true : false);
    }

    /**
     * check unPaid payment
     *
     * @param $payment
     * @return bool
     */
    private function unPaid($payment)
    {
        return ($payment->status == 0 ? true : false);
    }

    /**
     * get all paids payments
     *
     * @return array
     */
    protected function getPaids()
    {
        $amountPayments = array();
        foreach($this->payments as $payment){
            if ($this->paid($payment)) {
                $amountPayments[] = $payment;
            }
        }
        return $amountPayments;
    }


    /**
     * get all unpaids payments
     *
     * @return array
     */
    protected function getUnPaids()
    {
        $amountPayments = array();
        foreach($this->payments as $payment){
            if ($this->unpaid($payment)) {
                $amountPayments[] = $payment;
            }
        }
        return $amountPayments;
    }


    /**
     * sum all amount paid
     *
     * @return float|int
     */
    protected function sumAmountPaid()
    {
        $totalPaidAmount = array();
        foreach ($this->getPaids() as $payment)
        {
            $amount = str_replace( ',', '', $payment['amount'] );
            $totalAmount[] = $amount;
        }
        return $this->sum($totalPaidAmount);
    }

    /**
     * sum all amount unpaid
     *
     * @return float|int
     */
    protected function sumAmountUnPaid()
    {
        $totalUnPaidAmount = array();
        foreach ($this->getUnPaids() as $payment)
        {
            $amount = str_replace( ',', '', $payment['amount'] );
            $totalUnPaidAmount[] = $amount;
        }
        return $this->sum($totalUnPaidAmount);
    }

    protected function sumAmountes($invoiceId = null)
    {
        $amount = array();
        foreach($this->payments as $payment) {
            $comma = str_replace( ',', '', $payment['amount'] );
            $amount[] = $comma;
        }
        return $this->sum($amount);
    }

    /**
     * sum array values
     *
     * @param array $amounts
     * @return float|int
     */
    protected function sum(array $amounts)
    {
        $this->totalAmount = array_sum($amounts);
        return $this->totalAmount;
    }


    protected function tax()
    {
        $this->totalAmount = (self::TAX * $this->totalAmount) / 100;
        return $this;
    }

    public function updateInvoiceAmount(Invoice $invoice)
    {
        DB::transaction(function() use ($invoice)
        {
            $this->payments = $invoice->payments;
            $invoice->total_amount = $this->sumAmountes();
            $invoice->update();
            return true;
        });
    }


    /////////////////////////////////////////////////////////////////////

    protected function approve($id)
    {
        $payment = Payment::where('id',$id)->first();
        $payment->status = 1;
        $payment->payment_type = Config::get('constants.payment.PAY_MANUAL');
        $payment->update();


        //update status invoice
        $this->payments[] = $payment;
        if (($this->sumAmountUnPaid()) == 0) {
            $payment->invoice->status = 1;
        } else {
            $payment->invoice->status = 0;
        }
        $payment->invoice->save();

        return Redirect::back()->with('success','پرداختی مورد نظر با موفقیت تایید شد.');
    }

    public function store(Request $request , $invoiceId)
    {
        $this->validate(request(), [
            'price' => 'required|integer|min:1000',
            'description' => 'required|string',
        ]);

        DB::transaction(function() use ($invoiceId,$request)
        {
            $invoice = Invoice::where('id',$invoiceId)->first();

            $payment = new Payment;
            $payment->amount = $request->price;
            $payment->details = json_encode($request->description, JSON_UNESCAPED_SLASHES);
            $payment->status = 0;
            $payment->payment_type = 'unknown';

            $invoice->payments()->save($payment);

            //update status invoice
            $this->payments[] = $payment;
            if (($this->sumAmountUnPaid()) == 0) {
                $payment->invoice->status = 1;
            } else {
                $payment->invoice->status = 0;
            }
            $payment->invoice->save();

            //save amount invoice
            $this->updateInvoiceAmount($invoice);

        });

        return Redirect::back()->with('success','پرداختی مورد نظر با موفقیت اضافه شد.');

    }

    protected function destroy($id)
    {
        $payment = Payment::find($id);
        if (!is_null($payment)) {
            $payment->delete();

            //save amount invoice
            $invoice = Invoice::where('id',$payment->invoice->id)->first();
            $this->updateInvoiceAmount($invoice);

            return Redirect::back()->with('success','پرداخت مورد نظر با موفقیت حذف شد.');
        }
        return Redirect::back()->withErrors('این پرداختی قبلا حذف شده است.');
    }

}
