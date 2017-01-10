<?php
/**
 * --------------
 * 系统配置参数key-value相关实现
 * --------------
 * @authors Jea杨 (JJonline@JJonline.Cn)
 * @date    2017-1-10 17:18:55
 * @version $Id$
 */

namespace jframe;

class Config
{
    // 配置参数
    private static $config = [];

    /**
     * 加载配置文件（PHP格式）
     * @param string    $file 配置文件名
     * @param string    $name 配置名（如设置即表示二级配置）
     * @return mixed
     */
    public static function load($file, $name = '')
    {
        if (is_file($file)) {
            $name = strtolower($name);
            $type = pathinfo($file, PATHINFO_EXTENSION);
            if ('php' == $type) {
                return self::set(include $file, $name, $range);
            }
        } else {
            return self::$config;
        }
    }

    /**
     * 检测配置是否存在
     * @param string    $name 配置参数名（支持二级配置 .号分割）
     * @return bool
     */
    public static function has($name)
    {

        if (!strpos($name, '.')) {
            return isset(self::$config[strtolower($name)]);
        } else {
            // 二维数组设置和获取支持
            $name = explode('.', $name);
            return isset(self::$config[strtolower($name[0])][$name[1]]);
        }
    }

    /**
     * 获取配置参数 为空则获取所有配置
     * @param string    $name 配置参数名（支持二级配置 .号分割）
     * @return mixed
     */
    public static function get($name = null)
    {

        // 无参数时获取所有
        if (empty($name)) {
            return self::$config;
        }

        if (!strpos($name, '.')) {
            $name = strtolower($name);
            return isset(self::$config[$name]) ? self::$config[$name] : null;
        } else {
            // 二维数组设置和获取支持
            $name    = explode('.', $name);
            $name[0] = strtolower($name[0]);
            return isset(self::$config[$name[0]][$name[1]]) ? self::$config[$name[0]][$name[1]] : null;
        }
    }

    /**
     * 设置配置参数 name为数组则为批量设置
     * @param string|array  $name 配置参数名（支持二级配置 .号分割）
     * @param mixed         $value 配置值
     * @return mixed
     */
    public static function set($name, $value = null)
    {

        if (is_string($name)) {
            if (!strpos($name, '.')) {
                self::$config[strtolower($name)] = $value;
            } else {
                // 二维数组设置和获取支持
                $name                                         = explode('.', $name);
                self::$config[strtolower($name[0])][$name[1]] = $value;
            }
            return;
        } elseif (is_array($name)) {
            // 批量设置
            if (!empty($value)) {
                self::$config[$value] = isset(self::$config[$value]) ?
                array_merge(self::$config[$value], $name) :
                self::$config[$value] = $name;
                return self::$config[$value];
            } else {
                return self::$config = array_merge(self::$config, array_change_key_case($name));
            }
        } else {
            // 为空直接返回 已有配置
            return self::$config;
        }
    }

    /**
     * 重置配置参数
     */
    public static function reset()
    {
        self::$config = [];
        return true;
    }
}
