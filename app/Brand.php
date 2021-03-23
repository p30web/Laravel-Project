<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','slug',
    ];



    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'brands';


    /**
     * Get the models for the Brand.
     */
    public function models()
    {
        return $this->hasMany('App\Models')->select(['id', 'title', 'slug' , 'brand_id']);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
