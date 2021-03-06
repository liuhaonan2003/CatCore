<?php
/**
 * author: shenzhe
 * Date: 13-6-17
 */

namespace core\common;

/**
 * 格式化工具
 * Class Formater
 * @package core\common
 */
class Formater
{
    /**
     * 格式化Fatal错误
     * @param $error            array   错误信息
     * @param bool $trace       bool    是否打印trace信息
     * @return array                    格式化后的结果
     */
    public static function fatal($error, $trace=true)
    {
        $exceptionHash = array(
            'className' => 'fatal',
            'message' => $error['message'],
            'file' => $error['file'],
            'line' =>$error['line'],
            'userAgent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
            'trace' => array(),
        );

        if ($trace) {
            $traceItems = debug_backtrace();
            foreach ($traceItems as $traceItem) {
                $traceHash = array(
                    'file' => isset($traceItem['file']) ? $traceItem['file'] : 'null',
                    'line' => isset($traceItem['line']) ? $traceItem['line'] : 'null',
                    'function' => isset($traceItem['function']) ? $traceItem['function'] : 'null',
                    'args' => array(),
                );

                if (!empty($traceItem['class'])) {
                    $traceHash['class'] = $traceItem['class'];
                }

                if (!empty($traceItem['type'])) {
                    $traceHash['type'] = $traceItem['type'];
                }

                if (!empty($traceItem['args'])) {
                    foreach ($traceItem['args'] as $argsItem) {
                        $traceHash['args'][] = is_object($argsItem) ? get_object_vars($argsItem) : $argsItem;
                    }
                }

                $exceptionHash['trace'][] = $traceHash;
            }
        }

        return $exceptionHash;
    }

    /**
     * 格式化异常
     * @param $exception \Exception | \Error        异常对象
     * @param bool $trace                           是否打印trace信息
     * @return array                                格式化后的结果
     */
    public static function exception($exception, $trace = true)
    {
        $exceptionHash = array(
            'className' => 'Exception',
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'userAgent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
            'trace' => array(),
        );

        if ($trace) {
            $traceItems = $exception->getTrace();
            foreach ($traceItems as $traceItem) {
                $traceHash = array(
                    'file' => isset($traceItem['file']) ? $traceItem['file'] : 'null',
                    'line' => isset($traceItem['line']) ? $traceItem['line'] : 'null',
                    'function' => isset($traceItem['function']) ? $traceItem['function'] : 'null',
                    'args' => array(),
                );

                if (!empty($traceItem['class'])) {
                    $traceHash['class'] = $traceItem['class'];
                }

                if (!empty($traceItem['type'])) {
                    $traceHash['type'] = $traceItem['type'];
                }

                if (!empty($traceItem['args'])) {
                    foreach ($traceItem['args'] as $argsItem) {
                        $traceHash['args'][] = is_object($argsItem) ? get_object_vars($argsItem) : $argsItem;
                    }
                }

                $exceptionHash['trace'][] = $traceHash;
            }
        }

        return $exceptionHash;
    }

}