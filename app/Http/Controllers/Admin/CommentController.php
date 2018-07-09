<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 评论管理
class CommentController extends Controller
{
    public function index()
    {
        $data = DB::table("comment")
            ->select("comment.*","goods.title","goods.img as gimg","user.name")
            ->join("user","user.id","=","comment.uid")
            ->join("goods","goods.id","=","comment.gid")
            ->get();
        return view("admin.comment.index")->with("data",$data);
    }
    // 修改状态
    public function ajaxStatu(Request $request)
    {
        $arr = $request->except("_token");
        $sql = "update comment set statu=$arr[statu] where id=$arr[id]";
        if (DB::update($sql)) {
            return 1;
        }else{
            return 0;
        }
    }
}
