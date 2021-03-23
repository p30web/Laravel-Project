<?php

namespace App;

use App\Http\Controllers\PanelAdmin\PaymentController;
use Carbon\Carbon;
use Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoices';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','expert_id','sale_id','name_family','phone_number','detail',
        'total_amount','status'
    ];


    //get user for this invoice
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function expert()
    {
        return $this->belongsTo('App\Expert');
    }

    public function getTotalAmountAttribute($value)
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
     * set Caron shamsi date for update at attribute
     *
     * @param $value
     * @return mixed
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->shamsi()->format('Y/n/j H:i');
    }

    /**
     * Get the models for the Payment.
     */
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }


}
