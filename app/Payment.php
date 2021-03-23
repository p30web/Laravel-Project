<?php

namespace App;

use Carbon\Carbon;
use Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table ='payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id','amount','payment_type','transactionId','status','details'
    ];


    /**
     * @return BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }


    public function getAmountAttribute($value)
    {
        return number_format($value,0);
    }

    /**
     * set Caron shamsi date for Created at attribute
     *
     * @param $value
     * @return mixed
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->shamsi()->format('Y/n/j H:i');
    }

    /**
     * set Caron shamsi date for Created at attribute
     *
     * @param $value
     * @return mixed
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->shamsi()->format('Y/n/j H:i');
    }

    /**
     * set tax rate (%) for amount
     *
     * @param $value
     */
    public function setAmountAttribute($value)
    {
       $tax =  (Config::get('constants.payment.TAX_RATE') * $value) / 100;
       $this->attributes['amount'] = $value + $tax;
    }



}
