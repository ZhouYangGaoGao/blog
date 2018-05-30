<?php
/**
 * PHP version 7.1
 *
 * @description  异常
 * @author       weixing <weixing@zhengzai.tv>
 * @copyright    2015-2018 北京正在映画互联网科技有限公司
 * @createdate   2018-04-03
 */

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class Exceptions extends \RuntimeException implements HttpExceptionInterface
{

    private $statusCode;

    private $headers;

    /**
     * __construct.
     *
     *@param  string $message    数据校验
     *@param  string $code       数据校验
     *@param  string $statusCode 数据校验
     *@param  string $previous   数据校验
     *@param  string $headers    数据校验
     *
     *@return string
     */
    public function __construct($message = null, $code = null, $statusCode = null, \Exception $previous = null, array $headers = [])
    {
        $this->statusCode = $statusCode ?? 599;
        $this->headers = $headers;
        $code = $code ?? - 1;
        parent::__construct($message, $code, $previous);
    }

    /**
     * getStatusCode.
     *
     * @return void
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * get response headers.
     *
     * @return void
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set response headers.
     *
     * @param array $headers Response headers
     * @return void
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }
}

