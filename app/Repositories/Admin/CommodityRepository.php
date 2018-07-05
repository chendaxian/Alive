<?php

namespace App\Repositories\Admin;

use App\Models\Commodity;

class CommodityRepository
{
    const PAGINATENUM = 10;

    public function searchCommodity($input = NULL)
    {
        if ($input) {
            $arr = [];
            if ($input['name']) {
                array_push($arr, ['name', 'like', '%'.$input['name'].'%']);
            }

            if ($input['location']) {
                array_push($arr, ['location', 'like', '%'.$input['location'].'%']);
            }

            if ($input['is_shelves'] != 2) {
                array_push($arr, ['is_shelves', '=', $input['is_shelves']]);
            }

            if ($input['form_express_price']) {
                array_push($arr, ['express_price', '>=', $input['form_express_price']]);
            }
            if ($input['to_express_price']) {
                array_push($arr, ['express_price', '<=', $input['to_express_price']]);
            }

            if ($input['form_price']) {
                array_push($arr, ['price', '>=', $input['form_price']]);
            }

            if ($input['to_price']) {
                array_push($arr, ['price', '<=', $input['to_price']]);
            }

            if ($input['form_time']) {
                array_push($arr, ['created_at', '>=', $input['form_time']]);
            }

            if ($input['to_time']) {
                array_push($arr, ['created_at', '<=', date('y-m-d H:i:s', strtotime($input['to_time'])+24*60*60)]);
            }

            $data = Commodity::where($arr)->paginate($input['number']);
            $selOption = $input;
        } else {
            $data = Commodity::paginate(self::PAGINATENUM);
            $selOption['name'] = null;
            $selOption['location'] = null;
            $selOption['form_express_price'] = null;
            $selOption['to_express_price'] = null;
            $selOption['form_price'] = null;
            $selOption['to_price'] = null;
            $selOption['number'] = 10;
            $selOption['is_shelves'] = 2;
            $selOption['form_time'] = null;
            $selOption['to_time'] = null;
        }
        return array('data' => $data, 'selOption' => $selOption );;
    }
}