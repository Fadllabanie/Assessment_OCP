<?php

namespace Interface;

use Interface\JsonFile;
use Interface\HttpRequest;
use Interface\ReadableInterface;

class ReadFactory
{
    public function initialize(string $type ,$source): ReadableInterface
    {
        switch ($type) {
            case 'json-file':
                $class =  new JsonFile($source);
                $class->read();
                return $class;

            case 'http-request':
                $class =  new HttpRequest($source);
                $class->read();
                return $class;

            default:
                throw new \Exception("Reading method not supported");
                break;
        }
    }
}