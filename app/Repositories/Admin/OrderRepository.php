<?php

namespace App\Repositories\Admin;

use App\Models\Order;

class OrderRepository
{
    const PAGINATENUM = 10;

    public function searchOrder($input)
    {
        if (!empty($input)) {
            $arr = [];
            if ($input['order_number']) {
                array_push($arr, ['order_number', 'like', '%'.$input['order_number'].'%']);
            }

            if ($input['express_number']) {
                array_push($arr, ['express_number', 'like', '%'.$input['express_number'].'%']);
            }

            if ($input['receiver_name']) {
                array_push($arr, ['reveiver_name', 'like', '%'.$input['receiver_name'].'%']);
            }

            if ($input['staff_id']) {
                array_push($arr, ['staff_id', '=', $input['staff_id']]);
            }

            if ($input['order_status']) {
                array_push($arr, ['order_status', '=', $input['order_status']]);
            }

            if ($input['pay_status']) {
                array_push($arr, ['pay_status', '=', $input['pay_status']]);
            }

            if ($input['receiver_number']) {
                array_push($arr, ['reveiver_number', 'like', '%'.$input['receiver_number'].'%']);
            }

            if ($input['form_time']) {
                array_push($arr, ['created_at', '>=', $input['form_time']]);
            }

            if ($input['to_time']) {
                array_push($arr, ['created_at', '<=', date('y-m-d H:i:s', strtotime($input['to_time'])+24*60*60)]);
            }

            $data = Order::where($arr)->paginate($input['number']);
            $selOption = $input;
        } else {
            $data = Order::paginate(self::PAGINATENUM);
            $selOption['order_number'] = null;
            $selOption['express_number'] = null;
            $selOption['receiver_name'] = null;
            $selOption['staff_id'] = null;
            $selOption['receiver_number'] = null;
            $selOption['pay_status'] = null;
            $selOption['form_time'] = null;
            $selOption['to_time'] = null;
            $selOption['order_status'] = null;
            $selOption['number'] = 10;
        }
        return array('data' => $data, 'selOption' => $selOption );
    }
}