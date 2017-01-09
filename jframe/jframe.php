<?php
/**
 * JFrame框架核心入口
 * @authors Jea杨 (JJonline@JJonline.Cn)
 * @date    2017-01-01 21:28:44
 * @version $Id$
 */

define('JFRAME_VERSION','1.0-dev');
define('JFRAME_START_TIME', microtime(true));
define('JFRAME_START_MEM', memory_get_usage());
/**
 * 路径常量简写
 */
define('DS', DIRECTORY_SEPARATOR);
/**
 * JFrame框架所有文件目录
 */
define('JFRAME_PATH', __DIR__ . DS);
/**
 * JFrame框架library所在目录
 */
define('LIB_PATH', JFRAME_PATH . 'library' . DS);
/**
 * JFrame框架核心类所在目录
 */
define('CORE_PATH', LIB_PATH . 'jframe' . DS);
/**
 * 定义应用根目录，不提供入口文件自定义功能
 */
define('APP_PATH', dirname(__DIR__) . DS . 'application' . DS);
/**
 * 定义系统根目录(与web根目录有区别)
 */
define('ROOT_PATH', dirname(realpath(APP_PATH)) . DS);
/**
 * 定义composer的vender目录，入口文件可定义
 */
defined('VENDOR_PATH') or define('VENDOR_PATH', ROOT_PATH . 'vendor' . DS);
/**
 * 定义系统运行时相关目录的路径，入口文件可定义并修改
 */
defined('RUNTIME_PATH') or define('RUNTIME_PATH', APP_PATH . 'runtime' . DS);
defined('LOG_PATH') or define('LOG_PATH', RUNTIME_PATH . 'log' . DS);
defined('CACHE_PATH') or define('CACHE_PATH', RUNTIME_PATH . 'cache' . DS);
defined('TEMP_PATH') or define('TEMP_PATH', RUNTIME_PATH . 'temp' . DS);
/**
 * 定义系统所有配置项目的配置文件路径，入口文件可定义修改
 */
defined('CONF_FILE') or define('CONF_FILE', APP_PATH);

// 环境常量
define('IS_CLI', PHP_SAPI == 'cli' ? true : false);
define('IS_WIN', strpos(PHP_OS, 'WIN') !== false);

// 载入Loader类
require CORE_PATH . 'Loader.php';

// 载入helper函数
require JFRAME_PATH . 'helper.php';

// 注册自动加载
\jframe\Loader::register();

// 注册错误和异常处理机制
\jframe\Error::register();

// 加载配置文件
// \jframe\Config::set();
