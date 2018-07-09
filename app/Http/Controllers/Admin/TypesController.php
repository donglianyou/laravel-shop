<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TypesController extends Controller
{
    // 数据格式化处理方法
    /*public function data1($pid=0)
    {
        // 数据库查询
        $data = DB::table("types")->where("pid",$pid)->get();
        // 查询下一级分类
        foreach ($data as $value) {
            $value->son = $this->data($value->id);
        }
        return $data;
    }*/
   /* public function data($data,$pid=0)
    {
        // 获取顶级分类
        $newArr = array();
        foreach ($data as $key => $value) {
            if ($value->pid==$pid) {
                $newArr[$value->id] = $value;
                $newArr[$value->id]->son = $this->data($data,$value->id);
            }
        }
        return $newArr;
    }*/
    public function index()
    {
        /*// 一.面向过程方式(淘汰)：
        // 遍历所有顶级分类
        $one = DB::table('types')->where("pid",0)->get();
        // 遍历顶级分类的下级分类
        foreach ($one as $value) {
            $value->son = DB::table("types")->where("pid",$value->id)->get();
        }
        // 遍历查询三级分类
        foreach ($one as $value) {
            foreach ($value->son as $v) {
                $v->son = DB::table("types")->where("pid",$v->id)->get();
            }
        }
        echo "<pre>";
        print_r($one);
        exit();*/
        // 二.使用递归实现数据格式化：(查询次数太多不合理)
        // $arr = $this->data1();
        // 三.使用递归实现数据格式化：(不推荐)
        /*$data = DB::table("types")->get();
        $arr = $this->data($data,$pid=0);*/
        // 四.实现树形结构：
        $data = DB::table("types")->select("types.*",DB::raw("concat(path,id) as p"))->orderBy('p','asc')->paginate(8);
        $tot = DB::table("types")->count();
        return view('admin.types.index')->with(['data'=>$data,'tot'=>$tot]);
    }
    public function create()
    {
        return view('admin.types.add');
    }
    public function store(Request $request)
    {
        // 处理数据
        $data = $request->except('_token');
        // 插入数据
        if (DB::table("types")->insert($data)) {
            return redirect('admin/types');
        }else{
            return back();
        }
    }
    public function edit()
    {
        return view("admin.types.edit");
    }
    public function destroy($id)
    {
        // 删除操作
        if (DB::delete("delete from types where id=$id or path like '%,$id,%'")) {
            return 1;
        }else{
            return 0;
        }
    }
}
