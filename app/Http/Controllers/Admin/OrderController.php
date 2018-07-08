<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $data = Order::paginate(self::PAGINATENUM);
        return view('admin/order/index', compact(['data']));
    }

    public function updateReceiverInfo(Request $request)
    {
        $data = $request->except('hiddenId');
        $order = Order::findOrFail($request->hiddenId);
        $order->update($data);
        return redirect(route('orders'));
    }

    public function setDelivery(Request $request)
    {
        $row = Order::findOrFail($request->id);
        $data = $request->except('id');
        $data['order_status'] = 4;
        $data['staff_id'] = auth()->user()->id;
        $row->update($data);

        return response()->json(['res'=>true]);
    }
}
