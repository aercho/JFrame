<?php
/**
 * 错误、异常处理
 * --------------
 * 1、捕获错误、异常消息并统一封装处理
 * 2、捕获错误、异常后统一渲染错误提示页面并终止程序的运行
 * --------------
 * @authors Jea杨 (JJonline@JJonline.Cn)
 * @date    2017-01-06 16:59:23
 * @version $Id$
 */

namespace jframe;

use jframe\exception\ErrorException;
use jframe\exception\Handle;
use jframe\exception\ThrowableError;

class Error
{
    /**
     * 注册异常处理
     * @return void
     */
    public static function register()
    {
        error_reporting(E_ALL);
        set_error_handler([__CLASS__, 'appError']);
        set_exception_handler([__CLASS__, 'appException']);
        register_shutdown_function([__CLASS__, 'appShutdown']);
    }

    /**
     * Exception Handler
     * @param  \Exception|\Throwable $e
     */
    public static function appException($e)
    {
        //Error类型的错误异常在PHP7中被实现
        if (!$e instanceof \Exception) {
            $e = new ThrowableError($e);
        }

        //记录错误消息至日志系统--底层是否写入等依据debug模式
        self::getExceptionHandler()->report($e);
        //友好输出异常或错误信息
        self::getExceptionHandler()->send($e);
    }

    /**
     * Error Handler
     * @param  integer $errno   错误编号
     * @param  integer $errstr  详细错误信息
     * @param  string  $errfile 出错的文件
     * @param  integer $errline 出错行号
     * @param array    $errcontext
     * @throws ErrorException
     */
    public static function appError($errno, $errstr, $errfile = '', $errline = 0, $errcontext = [])
    {
        // 将错误信息托管至 jframe\exception\ErrorException 异常，由异常统一显示debug消息或记录日志
        $exception = new ErrorException($errno, $errstr, $errfile, $errline, $errcontext);

        // 由错误触发该方法，该方法手动抛出异常try、catch语句方可被承接到
        // 直接执行self::appException($exception);将跳过try、catch语句
        throw $exception;
    }

    /**
     * Shutdown Handler
     */
    public static function appShutdown()
    {
        if (!is_null($error = error_get_last()) && self::isFatal($error['type'])) {
            // 将致命错误托管至jframe\exception\ErrorException
            $exception = new ErrorException($error['type'], $error['message'], $error['file'], $error['line']);

            self::appException($exception);
        }

        // 写入日志
        // Log::save();
    }

    /**
     * 确定错误类型是否致命
     *
     * @param  int $type
     * @return bool
     */
    protected static function isFatal($type)
    {
        return in_array($type, [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE]);
    }

    /**
     * Get an instance of the exception handler.
     *
     * @return Handle
     */
    public static function getExceptionHandler()
    {
        static $handle;
        if (!$handle) {
            // 异常处理handle
            $class = '';//Config::get('exception_handle');
            if ($class && class_exists($class) && is_subclass_of($class, "\\jframe\\exception\\Handle")) {
                $handle = new $class;
            } else {
                $handle = new Handle;
            }
        }
        return $handle;
    }
}
