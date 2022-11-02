<?php

namespace App\Interface;

use App\Interface\JsonFile;
use App\Interface\HttpRequest;

class ReadFactory
{
    public function initialize(string $type, $source)
    {
        switch ($type) {
            case 'json-file':
                $class =  new JsonFile($source);
                return $class->read();

            case 'http-request':
               
                $class =  new HttpRequest($source);
                return  $class->read();

            default:
                throw new \Exception("Reading method not supported");
                break;
        }
    }
}
