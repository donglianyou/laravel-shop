<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

// 购物车
class CarController extends Controller
{
    public function index()
    {

        // 把session中的商品获取到
        $shop = session("shop");
        return view("home.car")->with("shop",$shop);
    }
    // 加入购物车方法
    public function addCar(Request $request)
    {
        // 数据处理
        $data = session('shop')?session('shop'):array();
        $a = 0;
        if ($data) {
            foreach ($data as $key => &$value) {
                if ($value['id'] == $_GET['id']) {
                    $value['num'] = $value['num'] + $_GET['num'];
                    $a = 1;
                }
            }
        }
        if (!$a) {
            $data[] = array(
                "id" => $_GET['id'],
                "num" => $_GET['num'],
                "goodsInfo" => DB::table("goods")->where("id",$_GET['id'])->first()
            );
        }
        $request->session()->put('shop',$data);
        return redirect("/car");
    }
    // ajax购物车添加
    public function CarAdd(Request $request)
    {
        // 获取修改的商品id
        $id = $request->input("id");
        // 获取session中商品数据
        $shop = session("shop");
        // 遍历数据
        foreach ($shop as $key => $value) {
            if ($value['id'] == $id) {
                $shop[$key]['num'] = ++$shop[$key]['num'];
            }
        }
        // 写入session
        $request->session()->put('shop',$shop);
        return 1;
    }
    // ajax购物车的减
    public function CarMinus(Request $request)
    {
        $id = $request->id;
        // 获取session中商品数据
        $shop = session("shop");
        // 遍历数据
        foreach ($shop as $key => $value) {
            if ($value['id'] == $id && $shop[$key]['num'] >1) {
                $shop[$key]['num'] = --$shop[$key]["num"];
            }
        }
        // 写入session
        $request->session()->put("shop",$shop);
        return 1;
    }
    public function CarDel(Request $request)
    {
        // 接收id
        $id = $request->id;
        // 获取购物车中所有的商品数据
        $shop = session("shop");
        // 遍历数据
        foreach ($shop as $key => $value) {
            // 判断需要删除的数据
            if ($value['id'] == $id) {
                unset($shop[$key]);
            }
        }
        // 写入session
        $request->session()->put("shop",$shop);
        return 1;
    }
    // 结算方法
    public function accounts(Request $request)
    {
        // 查询当前登录者收货地址
        $uid = session("lenovoHomeUserInfo.id");
        // 查询当前用户收货地址
        $addr = DB::table("addr")->where("uid",$uid)->get();
        // 接收选中商品数据
        $idArr = $request->goods;
        // 读取session
        $shop = session("shop");
        // 声明一个新数组
        $newArr = array();
        // 遍历购物车中选中的商品
        foreach ($idArr as $key => $value) {
            // 遍历购物车中所有的商品
            foreach ($shop as $k => $v) {
                // 判断是否是用户选中的商品
                if ($v['id'] == $value) {
                    $newArr[] = $v;
                }
            }
        }
        return view("home.accounts")->with(["newShop"=>$newArr,"addr"=>$addr]);
    }
}
