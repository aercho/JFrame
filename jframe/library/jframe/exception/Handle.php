<?php
/**
 * 处理了异常信息于浏览器中友好输出
 * @authors Jea杨 (JJonline@JJonline.Cn)
 * @date    2017-1-9 15:34:56
 * @version $Id$
 */

namespace jframe\exception;

use Exception;

class Handle
{

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        return;
        // 收集异常数据
        if (App::$debug) {
            $data = [
                'file'    => $exception->getFile(),
                'line'    => $exception->getLine(),
                'message' => $this->getMessage($exception),
                'code'    => $this->getCode($exception),
            ];
            $log = "[{$data['code']}]{$data['message']}[{$data['file']}:{$data['line']}]";
        } else {
            $data = [
                'code'    => $this->getCode($exception),
                'message' => $this->getMessage($exception),
            ];
            $log = "[{$data['code']}]{$data['message']}";
        }

        // Log::record($log, 'error');
    }

    /**
     * 处理异常信息并渲染成详细错误页面予以显示
     * @param  \Throwable $e 异常对象
     * @return void
     */
    public function send(Exception $exception)
    {
        dump($exception);
    }

    /**
     * 获取错误编码
     * ErrorException则使用错误级别作为错误编码
     * @param  \Exception $exception
     * @return integer                错误编码
     */
    protected function getCode(Exception $exception)
    {
        $code = $exception->getCode();
        if (!$code && $exception instanceof ErrorException) {
            $code = $exception->getSeverity();
        }
        return $code;
    }

    /**
     * 获取错误信息
     * ErrorException则使用错误级别作为错误编码
     * @param  \Exception $exception
     * @return string                错误信息
     */
    protected function getMessage(Exception $exception)
    {
        $message = $exception->getMessage();

        return $message;
    }

    /**
     * 获取出错文件内容
     * 获取错误的前9行和后9行
     * @param  \Exception $exception
     * @return array                 错误文件内容
     */
    protected function getSourceCode(Exception $exception)
    {
        // 读取前9行和后9行
        $line  = $exception->getLine();
        $first = ($line - 9 > 0) ? $line - 9 : 1;

        try {
            $contents = file($exception->getFile());
            $source   = [
                'first'  => $first,
                'source' => array_slice($contents, $first - 1, 19),
            ];
        } catch (Exception $e) {
            $source = [];
        }
        return $source;
    }

    /**
     * 获取常量列表
     * @return array 常量列表
     */
    private static function getConst()
    {
        return get_defined_constants(true)['user'];
    }
}
