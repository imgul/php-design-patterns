<?php

require __DIR__ . '/vendor/autoload.php';

use Imgul\PhpDesignPatterns\Creational\Builder\Conceptual\{Director, ClientCode};

$director = new Director();

new ClientCode($director);