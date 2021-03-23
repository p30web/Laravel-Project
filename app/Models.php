<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Facades\App\Repositories\Cache\ModelRepository;

class Models extends Model
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
    protected $table = 'models';



    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }



}
