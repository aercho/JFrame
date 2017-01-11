<?php
/**
 * --------------
 * Session-redis
 * --------------
 * @authors Jea杨 (JJonline@JJonline.Cn)
 * @date    2017-01-10 19:53:34
 * @version $Id$
 */

namespace jframe\session;

use SessionHandlerInterface;//不使用继承PHP内部用于揭示Session工作机制的SessionHandler对象

class Redis implements SessionHandlerInterface
{

    protected $handler = null;
    protected $config  = [
        'host'         => '127.0.0.1',  // redis主机
        'port'         => 6379,         // redis端口
        'password'     => '',           // 密码
        'select'       => 0,            // 操作库
        'expire'       => 3600,         // 有效期(秒)
        'timeout'      => 0,            // 超时时间(秒)
        'persistent'   => true,         // 是否长连接
        'session_name' => '',           // sessionkey前缀
    ];

    /**
     * 构造函数用于合并配置参数
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * 打开Session
     * @access public
     * @param string $savePath
     * @param mixed  $sessName
     * @return bool
     * @throws Exception
     */
    public function open($savePath, $sessName)
    {
        if (!extension_loaded('redis')) {
            throw new \BadFunctionCallException('not support: redis,please install redis extension at first.');
        }
        $this->handler = new \Redis;

        // 建立连接
        $func = $this->config['persistent'] ? 'pconnect' : 'connect';
        $this->handler->$func($this->config['host'], $this->config['port'], $this->config['timeout']);

        if ('' != $this->config['password']) {
            $this->handler->auth($this->config['password']);
        }

        if (0 != $this->config['select']) {
            $this->handler->select($this->config['select']);
        }

        return true;
    }

    /**
     * 关闭Session
     * @access public
     */
    public function close()
    {
        $this->gc(ini_get('session.gc_maxlifetime'));
        $this->handler->close();
        $this->handler = null;
        return true;
    }

    /**
     * 读取Session
     * @access public
     * @param string $sessID
     * @return string
     */
    public function read($sessID)
    {
        return (string) $this->handler->get($this->config['session_name'] . $sessID);
    }

    /**
     * 写入Session
     * @access public
     * @param string $sessID   当前请求下的session_id
     * @param String $sessData 当前请求下的待写入的所有已序列化好<可能是php内置的serialize也有可能是其他>的session数据
     * @return bool
     */
    public function write($sessID, $sessData)
    {
        if ($this->config['expire'] > 0) {
            return $this->handler->setex($this->config['session_name'] . $sessID, $this->config['expire'], $sessData);
        } else {
            return $this->handler->set($this->config['session_name'] . $sessID, $sessData);
        }
    }

    /**
     * 删除Session
     * @access public
     * @param string $sessID
     * @return bool
     */
    public function destroy($sessID)
    {
        return $this->handler->delete($this->config['session_name'] . $sessID) > 0;
    }

    /**
     * Session 垃圾回收
     * @access public
     * @param string $sessMaxLifeTime
     * @return bool
     */
    public function gc($sessMaxLifeTime)
    {
        return true;
    }
}
