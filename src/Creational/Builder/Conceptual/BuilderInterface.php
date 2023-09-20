<?php

namespace Imgul\PhpDesignPatterns\Creational\Builder\Conceptual;

class BuilderInterface
{
    public String $process;

    public function __construct()
    {
        $this->process = "Done";
    }

    public function buildPartA(): String
    {
        $this->process = " PartA";
        return $this->process;
    }
}
