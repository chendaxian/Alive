<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityCommodity;
use App\Traits\UploadFile;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    use UploadFile;

    public function index()
    {
        $data = Activity::paginate(self::PAGINATENUM);
        return view('admin/activity/index', compact(['data']));
    }

    public function add()
    {
        return view('admin/activity/add');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $dataImg = $request->only('img_index', 'img_detail');

        if (!empty($dataImg)) {
            foreach ($dataImg as $key => $value) {
                $data[$key] = $this->uploadImg($request->file($key), '/uploads/activity/');
            }
        }
        $row = new Activity();
        $row->create($data);

        return redirect(route('activities'));
    }

    public function delete($id)
    {
        Activity::find($id)->delete();
        return redirect(route('activities'));
    }

    public function update(Request $request)
    {
        $data = $request->except('hiddenId');
        $commodity = Activity::findOrFail($request->hiddenId);
        $dataImg = $request->only('img_index', 'img_detail');
        if (!empty($dataImg)) {
            foreach ($dataImg as $key => $value) {
                $data[$key] = $this->uploadImg($request->file($key), '/uploads/activity/');
                // 删除原有的图片文件
                $path = $commodity->$key;
                $path = substr($path, strpos($path, 'uploads/activity'));
                unlink(public_path().'/'.$path);
            }
        }
        $commodity->update($data);
        return redirect(route('activities'));
    }

    public function getActivities(Request $request)
    {
        $data = Activity::select('id', 'name')->get();
        return response()->json($data);
    }

    public function addCommodityToActivity(Request $request)
    {
        $row = new ActivityCommodity();
        $row->create($request->all());

        return response()->json(['res'=>true]);
    }
}
