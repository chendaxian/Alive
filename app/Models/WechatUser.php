<?php

namespace App\Models;

use App\Models\Scope\CreatedAtScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WechatUser extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CreatedAtScope());
    }
}
