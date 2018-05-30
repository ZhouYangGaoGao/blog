<?php
/**
 * Created by PhpStorm.
 * User: YangYang
 * Date: 2018/5/22
 * Time: 下午4:06
 */


use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers'], function ($api) {
        $api->group(['middleware' => 'auth'], function ($api) {
            $api->post('comments', 'CommentController@add');
            $api->delete('comments', 'CommentController@delete');

            $api->post('replies', 'ReplyController@add');
            $api->delete('replies', 'ReplyController@delete');
        });

        $api->get('/comments', 'CommentController@getList');
        $api->get('/comments/one', 'CommentController@getOne');
        $api->get('/replies', 'ReplyController@getList');
    });
});




/*$api = app('Dingo\Api\Routing\Router');
//
//$api->post('/comments', 'CommentController@add');
//$api->delete('/comments', 'CommentController@delete');
//
//$api->post('/replies', 'ReplyController@add');
//$api->delete('/replies', 'ReplyController@delete');
//$api->get('/comments', 'CommentController@getList');
//$api->get('/comments/one', 'CommentController@getOne');
//$api->get('/replies', 'ReplyController@getList');

$api->version('v1', function ($api) {
    //$api->group(['namespace' => 'App\Http\Controllers'], function ($api) {
        //$api->group(['middleware' => 'auth'], function ($api) {
            $api->post('/comments', 'CommentController@add');
            $api->delete('/comments', 'CommentController@delete');

            $api->post('/replies', 'ReplyController@add');
            $api->delete('/replies', 'ReplyController@delete');
        //});

        $api->get('/comments', 'CommentController@getList');
        $api->get('/comments/one', 'CommentController@getOne');
        $api->get('/replies', 'ReplyController@getList');


    //});
});*/