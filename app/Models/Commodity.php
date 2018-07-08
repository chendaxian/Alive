<?php

namespace App\Models;

use App\Models\Scope\CreatedAtScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commodity extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CreatedAtScope());
    }

    public function commodityType()
    {
        return $this->belongsTo('App\Models\CommodityType', 'commodity_types');
    }
}
