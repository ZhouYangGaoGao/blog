<?php
/**
 * Created by PhpStorm.
 * User: YangYang
 * Date: 2018/5/4
 * Time: 下午4:50
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Reply;
use App\Helpers\CustomValidator;
use App\Exceptions\Exceptions as HttpException;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->reply = new Reply();
        $this->customValidator = new CustomValidator();

    }

    public function show()
     {

     }

    public function add(Request $request){
        $data = $request -> all();
        $this->customValidator->run($data,'reply',['comment_id','uid','content']);
        $reply = new Reply();
        $reply->content=$data['content'];
        $reply->status=1;
        $reply->comment_id=$data['comment_id'];
        $reply->uid=$data['uid'];
        $reply->to_uid=$data['to_uid'];

        $reply->save();
        return '回复成功!';
    }
    public function getList(Request $request){
        return "";
    }
    public function delete(Request $request){
        return "删除成功";
    }
}