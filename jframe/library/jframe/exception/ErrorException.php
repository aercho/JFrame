<?php
/**
 * 错误异常-即php错误信息被异常来托管
 * @authors Jea杨 (JJonline@JJonline.Cn)
 * @date    2017-1-9 15:34:56
 * @version $Id$
 */

namespace jframe\exception;


/**
 * 
 * 主要用于封装
 * set_error_handler 和 register_shutdown_function 得到的*错误消息*成为一个可捕获的异常
 */
class ErrorException extends \Exception
{
    /**
     * 用于保存错误级别
     * @var integer
     */
    protected $severity;

    /**
     * 错误异常构造函数
     * @param integer $severity 错误级别
     * @param string  $message  错误详细信息
     * @param string  $file     出错文件路径
     * @param integer $line     出错行号
     * @param array   $context  错误上下文，会包含错误触发处作用域内所有变量的数组
     */
    public function __construct($severity, $message, $file, $line, array $context = [])
    {
        $this->severity = $severity;
        $this->message  = $message;
        $this->file     = $file;
        $this->line     = $line;
        $this->code     = 0;
    }

    /**
     * 获取错误级别
     * @return integer 错误级别
     */
    final public function getSeverity()
    {
        return $this->severity;
    }
}
