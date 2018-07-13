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
}
