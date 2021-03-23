<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'locations';

    /**
     * Get the models for the Brand.
     */
    public function packages()
    {
        return $this->hasMany('App\Package')->select('id','title','slug','description','price');
    }

    /**
     * Get the models for the Brand.
     */
    public function reserves()
    {
        return $this->hasMany('App\Reserve');
    }


}
