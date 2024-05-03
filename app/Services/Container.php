<?php

namespace App\Services;

class Container
{
    protected $services = [];

    public function bind($name, $resolver)
    {
        $this->services[$name] = $resolver;
    }

    public function resolve($name)
    {
        if (isset($this->services[$name])) {
            return call_user_func($this->services[$name]);
        }
        
        throw new \Exception("Service {$name} not registered.");
    }
}
