<?php

namespace Howkins\Borica\Utils;

class ParameterBag implements \IteratorAggregate, \Countable
{
    protected $parameters = [];

    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    public function all()
    {
        return $this->parameters;
    }

    public function except(array $keys = []){
        return array_diff_key($this->parameters, array_flip($keys));
    }

    public function keys()
    {
        return array_keys($this->parameters);
    }

    public function replace(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    public function add(array $parameters = [])
    {
        $this->parameters = array_replace($this->parameters, $parameters);
    }

    public function get($key, $default = null)
    {
        return \array_key_exists($key, $this->parameters) ? $this->parameters[$key] : $default;
    }

    public function set($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    public function has($key)
    {
        return \array_key_exists($key, $this->parameters);
    }

    public function remove($key)
    {
        unset($this->parameters[$key]);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->parameters);
    }

    public function count()
    {
        return \count($this->parameters);
    }
}
