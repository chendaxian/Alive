<?php

namespace App\Models;

use App\Models\Scope\CreatedAtScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CreatedAtScope());
    }

    public function commodities()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function staff()
    {
        return $this->belongsTo('App\User');
    }

    public function wechat()
    {
        return $this->belongsTo('App\Models\WechatUser', 'wechat_user_id');
    }
}
