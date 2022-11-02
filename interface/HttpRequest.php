<?php

namespace Interface;

use Interface\ReadableInterface;

class HttpRequest implements ReadableInterface
{

    public $source;

    public function __construct($source)
    {
        $this->source = $source;
    }

    public function read()
    {
    }
}
