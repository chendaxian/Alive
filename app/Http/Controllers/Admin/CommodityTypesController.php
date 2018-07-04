<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommodityType;
use App\Traits\UploadFile;
use Illuminate\Http\Request;

class CommodityTypesController extends Controller
{
    use UploadFile;

    public function index()
    {
        $data = CommodityType::paginate(self::PAGINATENUM);
        return view('admin/commodity-type/index', compact(['data']));
    }

    public function add()
    {
        return view('admin/commodity-type/add');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['img'] = $this->uploadImg($request->file('img'), '/uploads/commodityType/');
        $row = new CommodityType();
        $row->create($data);

        return redirect(route('commodityTypes'));
    }
}
