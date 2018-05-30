<?php
/**
 * Created by PhpStorm.
 * User: YangYang
 * Date: 2018/5/4
 * Time: 下午4:33
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'content', 'resource_id','resource_type','status','uid',
    ];

}