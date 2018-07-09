<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

// 后台广告
class AdsController extends Controller
{
    public function index()
    {
        $data = DB::table("ads")->orderBy("sort","desc")->paginate(5);
        return view('admin.sys.ads.index')->with("data",$data);
    }
    // 添加广告
    public function create()
    {
        return view("admin.sys.ads.add");
    }
    // 保存广告
    public function store(Request $request)
    {
        // 去除不需要的字段
        $data = $request->except("_token");
        if (DB::table("ads")->insert($data)) {
            return redirect("admin/sys/ads");
        }else{
            return back();
        }
    }
}
