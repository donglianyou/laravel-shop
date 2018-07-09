<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

// 订单管理
class OrdersController extends Controller
{
    public function index()
    {
        // 查询相关数据
        $data = DB::table("orders")
            ->select("orders.*","user.name","orders.code as code","orderstatu.name as ssname")
            ->join("user","user.id","=","orders.uid")
            ->join("orderstatu","orderstatu.id","=","orders.sid")
            ->get();
        $newArr = array();
        foreach ($data as $key => $value) {
            $newArr[$value->code] = $value;
        }
        return view("admin.orders.index")->with("data",$newArr);
    }
    // 查看订单详情
    public function lists(Request $request)
    {
        // 获取订单号
        $code = $request->code;
        // 查询订单号下所有商品
        $data = DB::table("orders")->select("orders.*","goods.title","goods.img")->join("goods","goods.id","=","orders.gid")->where("code",$code)->get();
        return view("admin.orders.lists")->with("data",$data);
    }
    // 查看收货地址
    public function addr(Request $request)
    {
        $id = $request->id;
        // 查询订单收货地址信息
        $data = DB::table("addr")->find($id);
        return view("admin.orders.addr")->with("data",$data);
    }
    // 订单状态的修改
    public function edit(Request $request)
    {
        if ($_POST) {
            $sid = $request->sid;
            $code = $request->code;
            $sql = "update orders set sid='$sid' where code='$code'";
            if (DB::update($sql)) {
                return redirect("admin/orders");
            }else{
                return back();
            }
        }else{
            // 查询所有订单状态
            $data = DB::table("orderstatu")->get();
            return view("admin.orders.edit")->with("data",$data);
        }
    }
    // 订单状态管理
    public function statuList(Request $request)
    {
        $data = DB::table("orderstatu")->get();
        return view("admin.orders.statuList")->with("data",$data);
    }
    // 订单状态修改
    public function ajaxStatu(Request $request)
    {
        $arr = $request->except("_token");
        $sql = "update orderstatu set name='$arr[name]' where id='$arr[id]'";
        if (DB::update($sql)) {
            return 1;
        }else{
            return 0;
        }
    }

}
