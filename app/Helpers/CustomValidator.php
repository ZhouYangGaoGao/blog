<?php
/**
 * PHP version 7.1
 *
 * @description  自定义validator，优化controller中的validator代码
 * @author       weixing <weixing@zhengzai.tv>
 * @copyright    2015-2018 北京正在映画互联网科技有限公司
 * @createdate   2018-04-17
 */

namespace App\Helpers;

use Validator;
use App\Exceptions\Exceptions as HttpException;

class CustomValidator extends Validator
{
    protected $rule = [    //所有验证字段的列表，以及每个字段的验证规则
        'comment' =>[
            'resource_id' =>'required',//资源id
            'resource_type' =>'required|numeric',//资源类型
            'uid' =>'required',//用户id
            'content' =>'required',//评论内容
        ],
        'reply' =>[
            'comment_id' =>'required',//评论id
            'uid' =>'required',//用户id
            'content' =>'required',//回复内容
        ],

    ];


    public function __construct()
    {
    }

    /**
     * 执行验证操作
     * @param array $data 需要验证的数据
     * @param string $ruleType 验证规则类型，对应$this->rule的第一层key
     * @param array $ruleList 需要验证的字段名
     * @return bool 是否成功，如果不成功则直接抛出异常
     */
    public function run($data, $ruleType, $ruleList)
    {
        $validatorRule = [];
        foreach ($ruleList as $v) {
            $validatorRule[$v] = $this->rule[$ruleType][$v];
        }
        $validator = parent::make($data, $validatorRule);
        if ($validator->fails()) {
            $messageArr = $validator->messages()->toArray();
            foreach ($messageArr as $v) {
                throw new HttpException($v[0], -1, 400);
            }
        }
        return true;
    }
}
