<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artisan;
// 后台首页控制器
class IndexController extends Controller
{
    // 后台首页
    public function index()
    {
        return view('admin.index');
    }
    // 删除文件的方法
    public function delDir($path)
    {
        // 读取路径
        $arr = scandir($path);
        // 遍历并删除
        foreach ($arr as $key => $value) {
            if ($value !="." && $value !="..") {
                Artisan::call("cache:clear");
                unlink($path.'/'.$value);
            }
        }
    }
    // 清除缓存
    public function cache()
    {
        $this->delDir("../storage/framework/views"); // 删除模板缓存
        return redirect('admin');
    }
}
