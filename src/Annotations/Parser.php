<?php

namespace Pkg6\Apidoc\Annotations;

use ReflectionClass;
use ReflectionMethod;

class Parser
{
    /**
     * 解析整个类，包含类级注解与方法注解
     *
     * @param string|object $class 类名或实例
     * @return array
     * @throws \ReflectionException
     */
    public static function classs($class): array
    {
        $reflection = new ReflectionClass($class);
        $result = [
            '_class' => [],
            '_methods' => [],
        ];
        // 类级注解
        $classDoc = $reflection->getDocComment();
        if ($classDoc) {
            $result['_class'] = self::parseDocComment($classDoc);
        }
        // 方法级注解
        foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            // 跳过继承方法
            // if ($method->class !== $reflection->getName()) continue;
            $doc = $method->getDocComment();
            if ($doc) {
                $result['_methods'][$method->getName()] = self::parseDocComment($doc);
            }
        }
        return $result;
    }

    /**
     * 解析 PHPDoc 注释为结构化数组
     *
     * @param string $comment
     * @return array
     */
    public static function parseDocComment(string $comment): array
    {
        $lines = explode("\n", $comment);
        $annotations = [];

        foreach ($lines as $line) {
            $line = trim($line, " \t\n\r\0\x0B*");

            if (preg_match('/^@(\w+)\((.*)\)$/', $line, $match)) {
                $tag = $match[1];
                $params = self::parseParams($match[2]);
                $annotations[$tag][] = $params;
            }
        }

        return $annotations;
    }

    /**
     * 解析 @注解(...) 中的参数
     *
     * @param string $paramStr
     * @return array
     */
    private static function parseParams(string $paramStr): array
    {
        $params = [];
        // 支持 key="value"、key='value'、key={json}
        preg_match_all('/(\w+)\s*=\s*("(?:[^"\\\\]|\\\\.)*"|\'(?:[^\'\\\\]|\\\\.)*\'|\{.*\})/', $paramStr, $matches, PREG_SET_ORDER);
        foreach ($matches as $m) {
            $key = $m[1];
            $val = trim($m[2], "\"'");
            $params[$key] = $val;
        }
        return $params;
    }
}