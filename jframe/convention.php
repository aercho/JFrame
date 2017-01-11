<?php
/**
 * 惯例配置文件--所有配置项
 * @authors Jea杨 (JJonline@JJonline.Cn)
 * @date    2017-01-10 19:53:34
 * @version $Id$
 */

return [

    // +----------------------------------------------------------------------
    // | 系统参数设置
    // +----------------------------------------------------------------------

    'app_debug'              =>  true,              // 应用开发模式，true显示调试信息，false线上运行不显示调试信息
    'default_return_type'    => 'html',             // 默认输出类型
    'default_ajax_return'    => 'json',             // 默认AJAX 数据返回格式,可选json xml
    'default_jsonp_handler'  => 'jsonpReturn',      // 默认JSONP格式返回的处理方法
    'var_jsonp_handler'      => 'callback',         // 默认JSONP处理方法
    'default_timezone'       => 'PRC',              // 默认时区
    'default_filter'         => 'trim',             // 默认全局过滤方法 用逗号分隔多个

    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------

    'default_controller'     => 'Index',            // 默认控制器名
    'default_action'         => 'index',            // 默认操作名
    'empty_controller'       => 'Error',            // 默认的空控制器名
    'empty_action'           => 'error',            // 默认的空操作名

    // +----------------------------------------------------------------------
    // | Smarty模板设置
    // +----------------------------------------------------------------------

    'smarty'               => [
        // 当前模板的视图目录 留空为自动获取
        'view_path'    => '',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '<%{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}%>',
    ],
    // 模板内容中特定字符串内容替换 key=>value
    'view_replace_str' => [],

    /**
     * 缓存相关配置
     * 1、type指定缓存类型，支持File、Redis、Memcache、Memcached四种，默认File
     * 2、依据type类型指定值的不同，配置项各异
     * -------------------------
     * ###File类型###
     * 'expire'        => 0,            //缓存有效期，0表示永久
     * 'cache_subdir'  => false,        //文件缓存是否拆分目录
     * 'prefix'        => '',           //缓存字段key前自动追加的前缀
     * 'path'          => CACHE_PATH,   //文件缓存的目录，默认通过CACHE_PATH常量配置，可在入口文件中定CACHE_PATH常量指定
     * 'data_compress' => false,        //文件缓存内容是否启用gzcompress压缩
     * -------------------------
     * 
     * -------------------------
     * ###Redis类型###
     * 'host'       => '127.0.0.1',     //redis链接地址
     * 'port'       => 6379,            //redis链接端口
     * 'password'   => '',              //redis链接密码
     * 'select'     => 0,               //是否使用redis的select指令指定Redis的数据库编号
     * 'timeout'    => 0,               //链接超时时长设置，单位秒，0表示不限制
     * 'expire'     => 0,               //缓存有效期，0表示永久
     * 'persistent' => false,           //是否使用长连接
     * 'prefix'     => '',              //缓存字段key前自动追加的前缀
     * -------------------------
     */
    'cache' => [
        'type'      => 'File',
        'prefix'    => 'jframe_',
        'expire'    => 0,
        'path'      => CACHE_PATH,
    ],

    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------

    'session'                => [
        // 驱动方式 支持redis memcache memcached，留空使用PHP系统默认
        'type'           => '',
        // SESSION 前缀
        'prefix'         => 'jframe',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------

    'cookie'                 => [
        // cookie 名称前缀
        'prefix'    => '',
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => '',
        //  cookie 启用安全传输
        'secure'    => false,
        // httponly设置
        'httponly'  => ''
    ],

    // +----------------------------------------------------------------------
    // | MySQL数据库设置
    // +----------------------------------------------------------------------

    'database'               => [
        // 服务器地址
        'hostname'       => 'localhost',
        // 数据库名
        'database'       => '',
        // 数据库用户名
        'username'       => 'root',
        // 数据库密码
        'password'       => '',
        // 数据库连接端口
        'hostport'       => '',
        // 数据库连接参数
        'params'         => [],
        // 数据库编码默认采用utf8
        'charset'        => 'utf8',
        // 数据库表前缀
        'prefix'         => '',
        // 数据库调试模式，ture将在日志中记录SQL语句
        'debug'          => false,
    ],
];