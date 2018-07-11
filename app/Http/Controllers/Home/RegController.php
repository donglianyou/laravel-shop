<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Code;
use Crypt;
use Mail;
// 注册
class RegController extends Controller
{
    public function index()
    {
        return view("home.reg");
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
    // 处理注册操作
    public function check(Request $request)
    {
        $arr = $request->except("_token");
        // 验证码检测
        require_once("../resources/code/Code.class.php");
        // 实例化
        $code = new Code();
        // 获取session
        $ocode = $code->get();
        // 检测验证码
        if (strtoupper($arr['code']) == $ocode) {
            // 验证密码位数
            if (strlen($arr['pass']) >=6 && strlen($arr['pass']) <=12) {
                // 判断是否邮箱
                if (preg_match('/\w+@\w+\.\w+/',$arr['email'])) {
                    // 判断邮箱是否注册
                    if (DB::table("user")->where("email",$arr['email'])->first()) {
                        return back()->with("error","邮箱已被注册！");
                    }else{
                        // 判断确认密码
                        if ($arr['pass'] == $arr['repass']) {
                            $data = [];
                            $data['name'] = $arr['name'];
                            $name = $arr['name'];
                            $data['email'] = $arr['email'];
                            $email = $arr['email'];
                            $data['pass'] = Crypt::encrypt($arr['pass']);
                            $data['tel'] = $arr['tel'];
                            $data['status'] = 0;
                            $data['time'] = time();
                            $data['token'] = str_random(50);
                            if ($id = DB::table("user")->insertGetID($data)) {
                                Mail::send('mail.index',["id"=>$id,"token"=>$data['token']],function ($message) use($email,$name) {
                                    $message->to($email, $name);
                                    $message->subject("亲爱的用户，恭喜您注册成功！");
                                });
                                // 加载立即激活的提示页面
                                $mailArr = explode("@",$email);
                                $href = "mail.".$mailArr[1];
                                return view("home.active")->with("href",$href);
                            }else{
                                return back()->with("error","注册失败！"); 
                            }
                        }else{
                            return back()->with("error","两次密码不一致！");
                        }
                    }
                }else{
                    return back()->with("error","邮箱格式错误！");
                }
            }else{
                return back()->with("error","密码长度不满足！");
            }
        }else{
            return back()->withErrors("error","验证码错误！");
        }
    }
    // 发送邮件
    public function sendEmail()
    {
        /*Mail::raw('这是联想商城网站测试', function ($message) {
            $message->to('donglianyoulove@126.com', '董联友');
        });*/
        Mail::send('mail.index',[],function ($message) {
            $message->to('1158624818@qq.com', 'lenovo user');
            $message->subject("亲爱的用户，恭喜您注册成功！");
        });
    }
    // 激活账户
    public function active($id,$token)
    {
        // 查询用户是否存在
        $data = DB::table("user")->where("id",$id)->first();
        // 判断token
        if ($token == $data->token) {
            $arr = [];
            $arr['status'] = 1;
            // 已经激活，让token过期
            $arr['token'] = str_random(50);
            // 进行数据库状态的修改，激活成功跳转到登录页面
            if (DB::table("user")->where("id",$id)->update($arr)) {
                return redirect("/login");
            }else{
                return redirect("/reg");
            }
        }else{
            echo "您的token已经过期";
        }
    }
}
