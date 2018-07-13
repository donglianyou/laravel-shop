<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Crypt;
use Mail;
// 登录
class LoginController extends Controller
{
    public function index()
    {
        // 获取上一个页面
        session(['prevPage' => $_SERVER['HTTP_REFERER']]);
        return view("home.login");
    }
    // 处理登录
    public function check(Request $request)
    {
        $email = $request->email;
        $pass = $request->pass;
        // 数据库中查询用户
        $data = DB::table("user")->where("email",$email)->first();
        if ($data) {
            // 判断密码是否正确
            if ($pass == Crypt::decrypt($data->pass)) {
                session(['lenovoHomeUserInfo.email' => $data->email]);
                session(['lenovoHomeUserInfo.name' => $data->name]);
                session(['lenovoHomeUserInfo.id' => $data->id]);
                return redirect(session("prevPage"));
            }else{
                return back();
            }
        }else{
            return back();
        }
    }
    // 退出登录
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect("/");
    }
    // 找回密码
    public function findPass(Request $request)
    {
        if ($_POST) {
            // 接收数据
            $email = $_POST['email'];
            // 查找邮箱
            $data = DB::table("user")->where("email",$email)->first();
            $name = $data->name;
            // 判断邮箱是否存在
            if ($data) {
                // 发送邮件
                Mail::send('mail.findPass',["id"=>$data->id,"token"=>$data->token],function ($message) use($email,$name) {
                    $message->to($email, $name);
                    $message->subject("找回密码！");
                });
                // 加载找回密码的提示页面
                $mailArr = explode("@",$email);
                $href = "mail.".$mailArr[1];
                return view("home.findTips")->with("href",$href);
            }else{
                return back();
            }
        }else{
            return view("home.findPass");
        }
        
    }
    // 修改密码
    public function savePass($id,$token)
    {
        // 判断post是否存在，存在修改密码
        if ($_POST) {
            // 判断密码是否一致
            if ($_POST['pass'] == $_POST['repass']) {
                // 验证密码长度
                if (strlen($_POST['pass']) >=6 && strlen($_POST['pass']) <=12) {
                    // 格式化数据并修改
                    $data = [];
                    $data['token'] = str_random(50);
                    $data['pass'] = Crypt::encrypt($_POST['pass']);
                    if (DB::table("user")->where("id",$id)->update($data)) {
                        return redirect("/login");
                    }else{
                        return back();
                    }
                }else{
                    return back();
                }
            }else{
                return back();
            }
        }else{
            return view("home.savePass");
        }
        
    }
}
