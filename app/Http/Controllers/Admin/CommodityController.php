<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommodityController extends Controller
{
    use UploadFile;

    public function index()
    {
        $data = Commodity::paginate(self::PAGINATENUM);
        return view('admin/commodity/index', ['data'=>$data]);
    }

    public function add()
    {
        return view('admin/commodity/add');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['img'] = $this->uploadImg($request->file('img'), '/uploads/commodity/');
        $row = new Commodity();
        $row->create($data);

        return redirect(route('commodities'));
    }

    public function update(Request $request)
    {
        $data = $request->except('hiddenId');
        $id = $request->hiddenId;
        $commodity = Commodity::findOrFail($id);
        if (isset($data['img'])) {
            $data['img'] = $this->uploadImg($request->file('img'), '/uploads/commodity/');
            // 删除原有的图片文件
            $path = $commodity->img;
            $path = substr($path, strpos($path, 'uploads/commodity'));
            unlink(public_path().'/'.$path);
        }
        $commodity->update($data);
        return redirect(route('commodities'));
    }

    public function delete($id)
    {
        Commodity::find($id)->delete();
        return redirect(route('commodities'));
    }
}
