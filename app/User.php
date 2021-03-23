<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\LaravelFilterable\Filterable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Yajra\Acl\Traits\HasRole;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable , HasRole , HasApiTokens , Filterable , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','family','code_melli','phone_number', 'email', 'password','phone_token','phone_token_fails'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','code_melli','adress'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advers()
    {
        return $this->hasMany('App\Advertising');
    }

    //get all invoices for user
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    public function experts()
    {
        return $this->hasMany('App\Expert');
    }

//    public function sales()
//    {
//        return $this->hasMany('App\Sale');
//    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->shamsi()->format('Y/n/j H:i');
    }


}
