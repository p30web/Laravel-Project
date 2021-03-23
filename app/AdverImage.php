<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdverImage extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'advertising_image';

    protected $fillable = [
        'image_path','advertising_id'
    ];

    public function adver()
    {
        return $this->belongsTo('App\Advertising');
    }


}
