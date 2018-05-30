<?php
/**
 * PHP version 7.1
 *
 * @description  ip定位
 * @author       weixing <weixing@zhengzai.tv>
 * @copyright    2015-2018 北京正在映画互联网科技有限公司
 * @createdate   2018-04-11
 */

namespace App\Helpers;

class Ip
{
    /**
     * 获取ip地址
     * @param string $ip ip地址
     * @return array 返回定位数组
     */
    public static function find($ip)
    {
        $resultArr = \Ip\Ip::find($ip);
        $city = str_replace('市市', '市', $resultArr[2].'市');
        return [
            'string' => $resultArr[1].' '.$city,
            'sourceData' => $resultArr,
        ];
    }
}
