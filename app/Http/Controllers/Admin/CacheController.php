<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Cache;

// 缓存控制器
class CacheController extends Controller
{
    public function index()
    {
        // $data = DB::table('user')->get();
        // 写入缓存
        // Cache::put('data', $data, 1);
        // 读取缓存
        $data = Cache::get('data');
        // 删除缓存
        // Cache::forget('data');
        // 删除所有缓存
        Cache::flush();
    }
}
