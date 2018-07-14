<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 生成订单
class OrdersController extends Controller
{
    public function index(Request $request)
    {
        // 接收收货地址id
        $aid = $request->input("aid");
        // 接收用户购买商品数据
        $ids = $request->input("ids");
        // 接收各个商品数量信息
        $nums = $request->input("nums");
        // 接收各个商品价格
        $prices = $request->input("prices");
        // 获取用户id
        $uid = session("lenovoHomeUserInfo.id");
        // 订单号的生成
        $code = "DZ_".time().rand();
        // 订单生成时间
        $time = time();
        // 生成订单
        for ($i=0; $i < count($ids); $i++) { 
            $data = array();
            $data['code'] = $code;
            $data['time'] = $time;
            $data['uid'] = $uid;
            $data['aid'] = $aid;
            $data['sid'] = 1;
            $data['gid'] = $ids[$i];
            $data['num'] = $nums[$i];
            $data['price'] = $prices[$i];
            $data['money'] = $prices[$i] * $nums[$i];
            // 插入订单信息
            DB::table("orders")->insert($data);
        }
        // 删除购物车中的商品，删除session中对应数据
        $shop = session('shop');
        // 遍历session中商品数据
        foreach ($shop as $key => $value) {
            foreach ($ids as $k => $v) {
                if ($v == $value['id']) {
                    unset($shop[$key]);
                }
            }
        }
        // 删除后重新写入session中
        $request->session()->put('shop',$shop);
        return redirect("pay/$code");
    }
    // 支付页面
    public function pay($code)
    {
        // 获取当前订单信息
        $orders = DB::table("orders")->where("code",$code)->get();
        return view("home.pay");
    }
}
