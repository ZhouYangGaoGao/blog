<?php
/**
 * PHP version 7.1
 *
 * @description  定义默认的返回信息
 * @author       weixing <weixing@zhengzai.tv>
 * @copyright    2015-2018 北京正在映画互联网科技有限公司
 * @createdate   2018-04-11
 */

namespace App\Helpers;

class Message
{
    /**
     * 定义接口返回为成功时的数组结构
     * @param void 不需要参数
     * @return array 默认的数组
     */
    static public function success()
    {
        return [
            'message' => 'OK',
        ];
    }

    /**
     * 定义接口返回为失败时的数组结构
     * @param void 不需要参数
     * @return array 默认的数组
     */
    static public function failure()
    {
        return [
            'message' => 'ERROR',
        ];
    }

    /**
     * 需要注册时的返回
     * @param void 不需要参数
     * @return array 默认的数组
     */
    static public function unregistered()
    {
        return [
            'message' => 'unregistered',
        ];
    }
}
