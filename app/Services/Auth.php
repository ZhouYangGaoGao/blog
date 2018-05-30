<?php
/**
 * PHP version 7.1
 *
 * @description  用户认证
 * @author       weixing <weixing@zhengzai.tv>
 * @copyright    2015-2018 北京正在映画互联网科技有限公司
 * @createdate   2018-04-06
 */

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\PayloadException;
use App\Exceptions\Exceptions as HttpException;

class Auth
{
    // use AuthenticatesUsers;
    // use Helpers;
    /**
     * 用户认证
     *
     * @return []
     */
    public function getAuthenticatedUser()
    {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return false;
        }
        return $user;
    }

    public function getUser()
    {
        $user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * 创建token
     *
     * @param object $user_obj 用户
     * @return []
     */
    public function createToken($user_obj)
    {
        // if (!is_object($user_obj))
        return JWTAuth::fromUser($user_obj);
        //return JWTAuth::attempt($user_obj);
    }

    /**
     * 获取token
     *
     * @return []
     */
    public function getToken()
    {
        return JWTAuth::gettoken();
    }

    /**
     * 设置token
     * @param string token
     * @return []
     */
    public function setToken($token)
    {
        return JWTAuth::settoken($token);
    }

    /**
     * 刷新token
     *
     * @return []
     */
    public function refresh()
    {
        return JWTAuth::refresh();
        //return JWTAuth::refresh(JWTAuth::gettoken());
    }

    /**
     * 获取token获取时间
     * @param void
     * @Return int 到期时间戳
     */
    public function getExpireTime()
    {
        try {
            $expireTime = JWTAuth::parseToken()->getPayload()->get('exp');
            return $expireTime;
        } catch (TokenExpiredException $e) {
            return false;
        }
    }

    /**
     * 获取用户id
     *
     * @return void
     */
    public function getUid()
    {
        try {
            $uid = JWTAuth::parseToken()->getPayload()->get('sub');
        } catch (TokenExpiredException $e) {
            return false;
        } catch (TokenInvalidException $e) {
            throw new HttpException($e->getMessage(), -1, 401);
        } catch (JWTException $e) {
            throw new HttpException($e->getMessage(), -1, 401);
        } catch (TokenBlacklistedException $e) {
            throw new HttpException($e->getMessage(), -1, 401);
        } catch (PayloadException $e) {
            throw new HttpException($e->getMessage(), -1, 401);
        }
        return $uid;
        /*if ($user = $this->getAuthenticatedUser()) {
            return $user->uid;
        }*/
    }

    /**
     * token加入黑名单(注销)
     *
     * @return []
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        $this->guard()->logout();
    }
}
