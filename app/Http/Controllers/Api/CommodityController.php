<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commodity;
use Illuminate\Http\Request;

class CommodityController extends Controller
{
    public function index()
    {
        $data = Commodity::select('id', 'name', 'price', 'express_price', 'sale_amounts', 'location', 'img')->get();
        return withDataResponse($data);
    }
}
