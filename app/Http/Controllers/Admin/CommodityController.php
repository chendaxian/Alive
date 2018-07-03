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
        $data['img'] = $this->uploadImg($request->file('img'), '/uploads/');
        $row = new Commodity();
        $row->create($data);

        return redirect(route('commodities'));
    }

    public function update(Request $request)
    {
        $data = $request->except('hiddenId');
        $id = $request->hiddenId;
        if (isset($data['img'])) {
            $data['img'] = $this->uploadImg($request->file('img'), '/uploads/');
        }
        Commodity::findOrFail($id)->update($data);
        return redirect(route('commodities'));
    }

    public function delete($id)
    {
        Commodity::find($id)->delete();
        return redirect(route('commodities'));
    }
}
