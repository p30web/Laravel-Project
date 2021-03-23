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

class Expert extends Model
{

    use SoftDeletes ;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'experts';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plaque','location_id','status','user_id','brand_id','model_id','health_status_id',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = ['id','created_at','updated_at','download_pdf_link','user_expert_id','tracking_code'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function adver()
    {
        return $this->hasOne('App\Advertising');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reserve()
    {
        return $this->hasOne('App\Reserve');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function properties()
    {
        return $this->hasOne(Properties::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    /**
     * Scope a query to only verify expert advers.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeVerify($query)
    {
        return  $query->where('status',1);
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
     * get brand id and set title
     *
     * @param $value
     * @return Response
     */
    public function getBrandIdAttribute($value)
    {
        $brnad = new BrandController();
        return $brnad->getTitleBrandById($value);
    }

    public function getTrackingCodeAttribute($value)
    {
        if (!empty($value)) {
            return 'MCE-' . $value;
        }
        return $value;
    }

    /**
     * get model id and set title
     *
     * @param $value
     * @return Response
     */
    public function getModelIdAttribute($value)
    {
        $model = new ModelController();
        return $model->getTitleModelById($value);
    }

}
