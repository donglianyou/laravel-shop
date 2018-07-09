<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

// 后台管理员控制器
class AdminController extends Controller
{
    // 管理员首页
    public function index()
    {
        $tot = DB::table('admin')->count();
        $admin = DB::table('admin') ->orderBy('id', 'desc')->paginate(5);
        return view('admin.admin.index')->with(['data'=>$admin,'tot'=>$tot]);
    }
    /*// 添加页面
    public function create()
    {
        return view('admin.admin.add');
    }*/
    // 插入操作
    public function store(Request $request)
    {
        // 把字符串数组化
        parse_str($_POST['str'],$arr);
        // 表单验证规则
        $rules = [
            'name' => 'required|unique:admin|between:2,12',
            'pass' => 'required|same:repass|between:6,12'
        ];
        // 表单验证提示信息
        $mess = [
            "name.required" => "请输入用户名！",
            "pass.required" => "请输入密码！",
            "name.unique" => "用户名已存在！",
            "pass.same" => "两次密码不一致!",
            "pass.between" => "密码长度不在2~12位之间!",
            "name.between" => "用户名长度不在6~12位之间!",
        ];
        // 表单验证
        $validator = \Validator::make($arr,$rules,$mess);
        // 开始验证
        if ($validator->passes()) { 
            // 验证通过，添加数据库
            unset($arr['repass']);
            $arr['pass'] = \Crypt::encrypt($arr['pass']);
            $arr['time'] = time();
            // 插入数据库
            if (DB::table('admin')->insert($arr)) {
                return 1;
            }else{
                return 0;
            }
        }else{
            return $validator->getMessageBag()->getMessages();
        }
    }
    // 修改页面
    public function edit($id)
    {
        // 查询数据
        $data = DB::table("admin")->find($id);
        $data->pass = \Crypt::decrypt($data->pass);
        return view('admin.admin.edit')->with("data",$data);
    }
    // 更新页面
    public function update(Request $request)
    {
        // 把字符串数组化
        parse_str($_POST['str'],$arr);
        // 表单验证规则
        $rules = [
            'pass' => 'required|same:repass|between:6,12'
        ];
        // 表单验证提示信息
        $mess = [
            "pass.required" => "请输入密码！",
            "pass.same" => "两次密码不一致!",
            "pass.between" => "密码长度不在2~12位之间!",
        ];
        // 表单验证
        $validator = \Validator::make($arr,$rules,$mess);
        // 开始验证
        if ($validator->passes()) { 
            // 验证通过，添加数据库
            unset($arr['repass']);
            $arr['pass'] = \Crypt::encrypt($arr['pass']);
            // 插入数据库
            if (DB::update("update admin set status = $arr[status],pass='$arr[pass]' where id = $arr[id]")) {
                return 1;
            }else{
                return 0;
            }
        }else{
            return $validator->getMessageBag()->getMessages();
        }
    }
    // 操作操作
    public function destroy($id)
    {
        // 删除数据
        if (DB::table("admin")->delete($id)) {
            return "1";
        }else{
            return "0";
        }
    }
    // 修改状态方法
    public function ajaxStatu(Request $request)
    {
        // 剔除不需要的数据
        $arr = $request->except('_token');
        if (DB::update("update admin set status = $arr[status] where id = $arr[id]")) {
            return 1;
        }else{
            return 0;
        }
    }
}
