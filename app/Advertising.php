<?php

namespace App;

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\ModelController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Response;
use Kyslik\LaravelFilterable\Filterable;
use Kyslik\LaravelFilterable\FilterContract;

class Advertising extends Model
{
    use Filterable , SoftDeletes;

//    protected $with = ['sale','expert','images'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'advertisings';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','slug','brand_id','model_id','expert_id','sale_id',
        'user_id',
    ];

    protected $hidden = ['id','user_id','created_at','updated_at','sale_id','expert_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expert()
    {
        return $this->belongsTo('App\Expert');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sale()
    {
        return $this->belongsTo('App\Sale');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\AdverImage');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function properties()
    {
        return $this->hasOne(Properties::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @param $value
     * @return \Illuminate\Http\Response
     */
    public function getBrandIdAttribute($value)
    {
        $brnad = new BrandController();
        return $brnad->getTitleBrandById($value);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
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


}
