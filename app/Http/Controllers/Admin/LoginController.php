<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
