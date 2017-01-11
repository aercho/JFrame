<?php
/**
 * 找不到类的异常
 * @authors Jea杨 (JJonline@JJonline.Cn)
 * @date    2017-01-06 15:20:25
 * @version $Id$
 */

namespace jframe\exception;

class ClassNotFoundException extends \RuntimeException
{
    protected $class;
    public function __construct($message, $class = '')
    {
        $this->message = $message;
        $this->class   = $class;
    }

    /**
     * 获取类名
     * @access public
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
}
