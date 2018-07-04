<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WechatUser;
use Illuminate\Http\Request;

class FansController extends Controller
{
    public function index()
    {
        $data = WechatUser::paginate(self::PAGINATENUM);
        return view('admin/fans/index', compact(['data']));
    }

    public function report()
    {
        return view('admin/fans/report');
    }
}
