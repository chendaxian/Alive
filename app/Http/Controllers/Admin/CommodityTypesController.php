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

    public function delete($id)
    {
        CommodityType::find($id)->delete();
        return redirect(route('commodityTypes'));
    }

    public function update(Request $request)
    {
        $data = $request->except('hiddenId');
        $id = $request->hiddenId;
        $commodityType = CommodityType::findOrFail($id);
        if (isset($data['img'])) {
            $data['img'] = $this->uploadImg($request->file('img'), '/uploads/commodityType/');
            // 删除原有的图片文件
            $path = $commodityType->img;
            $path = substr($path, strpos($path, 'uploads/commodityType'));
            unlink(public_path().'/'.$path);
        }
        $commodityType->update($data);
        return redirect(route('commodityTypes'));
    }
}
