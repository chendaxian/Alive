<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponUser;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $data = Coupon::paginate(self::PAGINATENUM);
        return view('admin/coupon/index', compact(['data']));
    }

    public function add()
    {
        return view('admin/coupon/add');
    }

    public function store(Request $request)
    {
        $row = new Coupon();
        $row->create($request->all());

        return redirect(route('coupons'));
    }

    public function delete($id)
    {
        Coupon::findOrFail($id)->delete();
        return redirect(route('coupons'));
    }

    public function update(Request $request)
    {
        $data = $request->except('hiddenId');
        $id = $request->hiddenId;
        $row = Coupon::findOrFail($id);
        $row->update($data);
        return redirect(route('coupons'));
    }

    public function check(Request $request)
    {
        $data = CouponUser::where('coupon_id', $request->id)->get();
        if (count($data) == 0) {
            return response()->json(['res'=>true]);
        } else {
            return response()->json(['res'=>false]);
        }
    }
}
