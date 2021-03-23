<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'properties_expert';

    protected $fillable = [
        'expert_id','health_rating','battery_health','mechanic','paint','electric',
        'safety','wheels','check_document','check_option'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adver()
    {
        return $this->belongsTo(Advertising::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}
