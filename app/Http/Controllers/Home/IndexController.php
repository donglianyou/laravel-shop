<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Cache;

class IndexController extends Controller
{
    // 分类数据的处理
    public function checkTypeData($data,$pid=0)
    {
        // 新建数据
        $newArr = array();
        // 获取数据
        foreach ($data as $key => $value) {
            if ($value->pid==$pid) {
                $newArr[$value->id] = $value;
                $newArr[$value->id]->son = $this->checkTypeData($data,$value->id);
            }
        }
        // 返回数据
        return $newArr;
    }
    public function index()
    {
        // 查询轮播图(设置缓存)
        if ($slider = Cache::get('slider')) {
            # code...
        }else{
            $slider = DB::table("slider")->orderBy("order","desc")->get();
            Cache::put('slider', $slider,10);
        }
        
        // 查询广告(设置缓存)
        if ($ads = Cache::get('ads')) {
            # code...
        }else{
            $ads = DB::table("ads")->orderBy("sort","desc")->get();
            Cache::put('ads', $ads,10);
        }

        // 递归处理数据
        $types = DB::table("types")->get();
        $type = $this->checkTypeData($types);

        // 处理右侧广告
        foreach ($type as $key => $value) {
            $value->rightAds = DB::table("typesads")->where([["cid","=",$value->id],['type','=',0]])->limit(2)->get();
            $value->leftAds = DB::table("typesads")->where([["cid","=",$value->id],['type','=',1]])->first();
        }
        // 处理楼层的商品
        foreach ($type as $key => $value) {
            $newArr = [];
            // 遍历二级分类
            foreach ($value->son as $two) {
                // 遍历三级分类
                foreach ($two->son as $three) {
                    $newArr[] = $three->id;
                }
            }
            // 查询对应的商品
            $value->goods = DB::table("goods")->whereIn("cid",$newArr)->limit(8)->get();
        }
        // 明星单品
        $goods = DB::table("goods")->limit(6)->orderBy("id","desc")->get();
        // 格式化数据
        $data = array(
            "slider"=>$slider,
            "ads"=>$ads,
            "type"=>$type,
            "goods"=>$goods
        );
        return view("home.index")->with($data);
    }
}
