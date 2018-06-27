<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommodityController extends Controller
{
    public function index()
    {
        $data = DB::table('commodity')->paginate(self::PAGINATENUM);
        return view('admin/commodity/index', ['data'=>$data]);
    }

    public function add()
    {
        return view('admin/commodity/add');
    }
}
