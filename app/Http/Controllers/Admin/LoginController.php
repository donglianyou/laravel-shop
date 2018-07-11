<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Crypt;

class LoginController extends Controller
{
    public function index()
    {

        return view('Admin.login');
    }
    // 验证码
    public function yzm()
    {
        require_once("../resources/code/Code.class.php");
        // 实例化
        $code = new \Code();
        // 生成验证码
        $code->make();
    }
    // 登录验证
    public function check(Request $request)
    {
        $name = $request->input('name');
        $pass = $request->input('pass');
        $ucode = $request->input('code');
        // 验证验证码
        require_once("../resources/code/Code.class.php");
        // 实例化
        $code = new \Code();
        // 获取session
        $ocode = $code->get();
        // 检测验证码
        if (strtoupper($ucode) == $ocode) {
            // 验证密码
            $data = DB::table("admin")->where([['name','=',"$name"],['status','=','0']])->first();
            if ($data) {
                if ($pass == Crypt::decrypt($data->pass)) {
                    // 声明数组
                    $arr = [];
                    $arr['lasttime'] = time();
                    $arr['count'] = ++$data->count;
                    // 更新登录信息
                    DB::table("admin")->where('id',$data->id)->update($arr);
                    // 存session
                    $newArr = [];
                    $newArr['name'] = $data->name;
                    $newArr['id'] = $data->id;
                    session(['lenovoAdminUserInfo'=>$newArr]);
                    // 登录成功跳转首页
                    return redirect('admin');
                }else{
                    return back()->with("error","密码错误！");
                }
            }else{
                return back()->with("error","用户名不存在！");
            }
        }else{
            return back()->with("error","验证码错误！");
        }
    }
    // 退出登录
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect("/admin/login");
    }
}
