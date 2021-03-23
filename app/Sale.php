<?php

namespace App;

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\ModelController;
use Carbon\Carbon;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Response;

class Sale extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id','updated_at','description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'production_id','color_id','city_id','amortization','description','price','bodystatus_id','placestain_id',
        'town_id', 'status','in_place','cash','chassisـtype','girbox','car_status','differential',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function adver()
    {
        return $this->hasOne('App\Advertising');
    }


    /**
     * Scope a query to only verify sale advers.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeVerify($query)
    {
        return  $query->where('status',1)->orWhere('status',3);
    }


    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->shamsi()->format('Y/n/j H:i');
    }


}
