<?php
/**
 * Created by PhpStorm.
 * User: YangYang
 * Date: 2018/5/4
 * Time: 下午4:50
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Reply;
use App\Helpers\CustomValidator;
use App\Exceptions\Exceptions as HttpException;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->comment = new Comment();
        $this->reply = new Reply();
        $this->customValidator = new CustomValidator();
    }

    public function show()
     {

     }

     public function getList(Request $request){

        $per_page = $request->get('per_page', 10);
        $resource_id = $request->get('resource_id');
        $commentData = $this->comment->where('resource_id',$resource_id)
             ->paginate($per_page)
             ->toArray();

        foreach ($commentData['data'] as $k => $v) {
            $comment_id = $commentData['data'][$k]['id'];
                $replayData = $this->reply->where('comment_id',$comment_id)
                    ->take(3)
                    ->get()
                    ->toArray();

                $commentData['data'][$k]['replay'] = [];
                $commentData['data'][$k]['replay']['count'] = 25;
                $commentData['data'][$k]['replay']['data'] = $replayData;

        }
        return $commentData;

     }

    public function add(Request $request){
        $data = $request -> all();
        $this->customValidator->run($data,'comment',['resource_id','resource_type','uid','content']);
        $comment = new Comment();
        $comment->content=$data['content'];
        $comment->status=1;
        $comment->resource_id=$data['resource_id'];
        $comment->resource_type=$data['resource_type'];
        $comment->uid=$data['uid'];
        $comment->save();
        return '评论成功!';
    }

    public function getOne(Request $request){
        $id = $request->get('id');
        $commentOne = $this->comment->where('id',$id)
        ->get();
        return $commentOne;
    }
    public function delete(Request $request){
        $id = $request->get('id');
        $this->comment->delete('id',$id);
        return '删除成功!';
    }
}