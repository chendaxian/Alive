<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Admin\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderRepo;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function index(Request $request)
    {
        $data = $this->orderRepo->searchOrder($request->all());
        return view('admin/order/index', ['data'=>$data['data'], 'selOption'=>$data['selOption']]);
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
        $data['order_status'] = 2;
        $data['staff_id'] = auth()->user()->id;
        $row->update($data);

        return response()->json(['res'=>true]);
    }
}
