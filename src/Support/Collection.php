<?php

namespace Pkg6\Apidoc\Support;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;

/**
 * 数据集管理类
 *
 * @template TKey of array-key
 * @template-covariant TValue
 *
 * @implements ArrayAccess<TKey, TValue>
 * @implements IteratorAggregate<TKey, TValue>
 */
class Collection implements ArrayAccess, Countable, IteratorAggregate, JsonSerializable
{
    /**
     * 数据集数据
     * @var array
     */
    protected $items = [];

    /**
     * 构造函数
     * @param iterable<TKey, TValue>|Collection<TKey, TValue> $items 数据
     */
    public function __construct($items = [])
    {
        $this->items = $this->convertToArray($items);
    }

    /**
     * @param iterable<TKey, TValue>|Collection<TKey, TValue> $items
     * @return static<TKey, TValue>
     */
    public static function make($items = [])
    {
        return new static($items);
    }

    /**
     * 合并数组
     *
     * @param mixed $items 数据
     * @return static
     */
    public function merge($items)
    {
        return new static(array_merge($this->items, $this->convertToArray($items)));
    }

    /**
     * 返回数组中所有的值组成的新 Collection 实例
     * @return static<int, TValue>
     */
    public function values()
    {
        return new static(array_values($this->items));
    }

    /**
     * 删除数组的最后一个元素（出栈）
     *
     * @return TValue
     */
    public function pop()
    {
        return array_pop($this->items);
    }

    /**
     * 在数组开头插入一个元素
     *
     * @param mixed $value 元素
     * @param string|null $key KEY
     * @return $this
     */
    public function unshift($value, ?string $key = null)
    {
        if (is_null($key)) {
            array_unshift($this->items, $value);
        } else {
            $this->items = [$key => $value] + $this->items;
        }

        return $this;
    }

    /**
     * 在数组结尾插入一个元素
     *
     * @param mixed $value 元素
     * @param string|null $key KEY
     * @return $this
     */
    public function push($value, ?string $key = null)
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
        return $this;
    }

    /**
     * 是否为空
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * @return array<TKey, TValue>
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * 转换当前数据集为JSON字符串
     *
     * @param integer $options json参数
     * @return string
     */
    public function toJson(int $options = JSON_UNESCAPED_UNICODE): string
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * 转换成数组
     *
     * @param mixed $items 数据
     * @return array
     */
    protected function convertToArray($items): array
    {
        if ($items instanceof self) {
            return $items->all();
        }
        return (array)$items;
    }

    public function toArray(): array
    {
        return array_map(function ($value) {
            return $value;
        }, $this->items);
    }

    /**
     * @param $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    public function count()
    {
        return count($this->items);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }

    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    public function __toString()
    {
        return $this->toJson();
    }
}