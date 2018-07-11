<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TypesController extends Controller
{
    public function index($id)
    {
        // 查询所有的顶级分类
        $types = DB::table("types")->where("pid",0)->get();
        // 查询当前分类
        $type = DB::table("types")->where("id",$id)->first();
        // 将path路径处理成数组
        $arr = explode(",",$type->path);
        $size = count($arr)-1;
        switch ($size) {
            case '1':
                $sonClass = DB::table("types")->where([["path","like","%,$id,%"],["pid","!=",$id]])->get();
                $newArr = [];
                foreach ($sonClass as $key => $value) {
                    $newArr[] = $value->id;
                }
                $goods = DB::table("goods")->whereIn("cid",$newArr)->get();
                break;
            case '2':
                $goodsClass = DB::table("types")->where("pid",$id)->get();
                $newArr = [];
                foreach ($goodsClass as $key => $value) {
                    $newArr[] = $value->id;
                }
                $goods = DB::table("goods")->whereIn("cid",$newArr)->get();
                break;
            case '3':
                $goods = DB::table("goods")->where("cid",$id)->get();
                break;
        }
        // 顶级分类
        $top = $arr[1] ? $arr[1] : $id;
        // 格式化数据
        $data = array(
            "types"=>$types,
            "top"=>$top,
            "goods"=>$goods
        );
        return view('home.types')->with($data);
    }
}
