<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SecKillController extends Controller
{
    const WITH_SUCCESS_MARK = 1;

    const WITH_FAIL_MARK = 2;
    
    const WITH_REPEAT_MARK = 3;

    public function index()
    {
        return view('client/seckill');
    }

    public function formSubmit(Request $request)
    {
        $wechatAccount = $request->get('phoneNumber');
        $ip = $request->getClientIp(); 
        $exit = DB::table('seckill_list')->where('ip', $ip)->first();
        if ($exit) {
            $res = self::WITH_REPEAT_MARK;
        } else {
            $res = DB::table('seckill_list')
                ->insert(['wechat_account' => $wechatAccount, 'ip' => $ip, 'created_at'=>Carbon::now('Asia/Shanghai')]);
            if ($res) {
                $res = self::WITH_SUCCESS_MARK;
            } else {
                $res = self::WITH_FAIL_MARK;
            }
        }
        return response()->json(['result'=>$res]);
    }
}
