<?php

require __DIR__ . '/vendor/autoload.php';

use Imgul\PhpDesignPatterns\Creational\Builder\Conceptual\BuilderInterface;

$builder = new BuilderInterface();

$process = $builder->buildPartA();

echo $process;