<?php
/**
 * Created by PhpStorm.
 * User: YangYang
 * Date: 2018/5/4
 * Time: 下午4:41
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class reply extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'content', 'comment_id','to_uid','status','uid','created_at','update_at',
    ];

}