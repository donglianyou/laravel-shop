<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

// 广告分类
class TypesAdsController extends Controller
{
    public function index()
    {
        $data = DB::table("typesads")->select('typesads.*','types.name')->join('types','typesads.cid','=','types.id')->paginate(5);
        return view('admin.sys.types.index')->with(["data"=>$data]);
    }
    public function create()
    {
        $data = DB::table("types")->where("pid",0)->get();
        return view('admin.sys.types.add')->with("data",$data);
    }
    // 保存分类广告
    public function store(Request $request)
    {
        // 剔除不需要的数据
        $arr = $request->except('_token');
        if (DB::table("typesads")->insert($arr)) {
            return redirect("admin/sys/types");
        }else{
            return back();
        }
    }
}
