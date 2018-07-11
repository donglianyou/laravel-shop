<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GoodsController extends Controller
{
    public function index($id)
    {
        // 获取商品相关数据
        $goods = DB::table("goods")->where("id",$id)->first();
        // 商品图片表
        $goodsImg = DB::table("goodsimg")->where("gid",$id)->get();
        // 查询商品对应评论
        $comment = DB::table("comment")
            ->select("comment.*","user.name")
            ->join("user","user.id","=","comment.uid")
            ->where([["gid","=",$id],["statu","=",1]])->get();
        $commentTot = DB::table("comment")->where("gid",$id)->count();
        $goodTot = DB::table("comment")->where([['gid','=',$id],["start",">",4]])->count();
        $badTot = DB::table("comment")->where([['gid','=',$id],["start","<=",2]])->count();
        $midTot = $commentTot - $goodTot - $badTot;
        $arr = array(
            "commentTot"=>$commentTot,
            "goodTot"=>$goodTot,
            "badTot"=>$badTot,
            "midTot"=>$midTot
        );
        // 格式化数据
        $data = array(
            "goods"=>$goods,
            "goodsImg"=>$goodsImg,
            "comment"=>$comment,
            "arr"=>$arr
        );
        return view("home.goods")->with($data);
    }
}
