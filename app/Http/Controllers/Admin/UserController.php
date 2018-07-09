<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

// 后台首页控制器
class UserController extends Controller
{
    // 后台首页
    public function index(Request $request)
    {
        $search = $request->search;
        if ($search) {
            // 数据查询
            $tot=  DB::table("user")->where("tel","=",$search)->count();
            $data = DB::table("user")->where("tel","=",$search)->paginate(5);
        }else{
            // 读取数据
            $tot=  DB::table("user")->count();
            $data = DB::table("user")->paginate(5);
        }
        return view('admin.user.index')->with(['data'=>$data,'tot'=>$tot]);
    }
}
