<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 商品管理
class GoodsController extends Controller
{
    public function index()
    {
        $tot = DB::table("goods")->count();
        $data = DB::table("goods")->orderBy("id","desc")->paginate(5);
        // 处理小图
        foreach ($data as $key => $value) {
            $value->tupian = DB::table("goodsimg")->where('gid',$value->id)->get();
        }
        return view('admin.goods.index')->with(['data'=>$data,'tot'=>$tot]);
    }
    // 商品添加页面
    public function create()
    {
        // 查询分类
        $data = DB::select("select types.*,concat(path,id) p from types order by p");
        // 分类数据处理
        foreach ($data as $key => $value) {
            $arr = explode(",",$value->path);
            $size = count($arr);
            $value->size = $size-2;
            $value->html = str_repeat('|----', $size-2).$value->name;
        }
        return view("admin.goods.add")->with("data",$data);
    }
    public function store(Request $request)
    {
        // 获取多图
        $imgs=$request->imgs;
        // 移除不需要的字段
        $data = $request->except('_token','imgs');
        // 插入数据库
        if ($id = DB::table("goods")->insertGetId($data)) {
            // 多图插入到数据库表中
            $arr = explode(',', $imgs);
            foreach ($arr as $key => $value) {
                $brr = array();
                $brr['gid'] = $id;
                $brr['img'] = $value;
                DB::table('goodsimg')->insert($brr);
            }
            return redirect('admin/goods');
        }else{
            return back();
        }
    }
}
