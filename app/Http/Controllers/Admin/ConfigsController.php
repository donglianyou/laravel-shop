<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 后台配置
class ConfigsController extends Controller
{
    public function index()
    {
        return view('admin.sys.config.index');
    }
    public function store(Request $request)
    {
        // 接收原图
        $oldLogo = $request->oldLogo;
        // 剔除不需要的数据
        $arr = $request->except("_token,oldLogo");
        $val = var_export($arr,true);
        $str = "<?php
return ".$val.";
?>";  //将数组转换成字符串形式,然后拼接
        // 写入到配置文件
        if (file_put_contents('../config/web.php', $str)) {
            if ($oldLogo == $request->input("logo")) {
                # code...
            }else{
                if (file_exists("./Uploads/sys/".$oldLogo)) {
                    unlink("./Uploads/sys/".$oldLogo);
                }else{
                    return back();
                }
            }
            return back();
        }
    }
}
