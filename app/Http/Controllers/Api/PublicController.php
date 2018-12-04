<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use DB;

class PublicController extends Controller
{
    /**
     * @param $total:总数
     * @param $n:天数
     * @return mixed
     */
    public function total($total,$n)
    {
        if($n == 1) return $total;
        $total = ($total + 1) * 2;
        return $this->total($total,$n-1);
    }

    public function test($total = 1,$n = 10)
    {
        $url = "https://taieusexy.oss-cn-hangzhou.aliyuncs.com/image/59d8055b5b437b78e87239dd05dfb7ab.jpg";
        $ext = explode('.', parse_url($url)['path']);
        $ext = array_pop($ext);
        return $ext;
    }

}
