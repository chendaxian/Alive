<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commodity extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function commodityType()
    {
        return $this->belongsTo('App\Models\CommodityType', 'commodity_types');
    }
}
