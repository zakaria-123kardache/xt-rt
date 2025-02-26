<?php
namespace App\Routes;


class Route {
    public $path;
    public $callable;

    public function __construct($path, $callable)
    {
        $this->path = $path;
        $this->callable = $callable;
    }
}

