<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

// 轮播图
class SliderController extends Controller
{
    public function index()
    {
        $tot = DB::table('slider')->count();
        $data = DB::table('slider')->paginate(5);
        return view('admin.sys.slider.index')->with(['tot'=>$tot,'data'=>$data]);
    }
    public function store(Request $request)
    {
        $arr = $request->except("_token");
        // 表单验证规则
        $rules = [
            'title' => 'required',
            'href' => 'required',
            'order' => 'required',
            'img' => 'required'
        ];
        // 表单验证提示信息
        $mess = [
            "title.required" => "请输入标题！",
            "href.required" => "请输入友情链接！",
            "order.required" => "请输入排序！",
            "img.required" => "请选择图片！",
        ];
        // 表单验证
        $validator = \Validator::make($arr,$rules,$mess);
        // 开始验证
        if ($validator->passes()) { 
            // 验证通过，添加数据库
           
            // 插入数据库
            if (DB::table('slider')->insert($arr)) {
                return redirect('admin/sys/slider');
            }else{
                return back();
            }
        }else{
            return back()->withInput()->withErrors($validator);
        }
    }
}
