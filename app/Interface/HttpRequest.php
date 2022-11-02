<?php

namespace App\Interface;

use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use App\Interface\ReadableInterface;
use App\Services\TransactionService;

class HttpRequest implements ReadableInterface
{

    public $source;

    public function __construct($source)
    {
        $this->source = $source;
    }

    public function read()
    {
      
        if ($this->source->route()->getName() == 'add.users') {

            UserService::crateFromData($this->source);

        } elseif ($this->source->route()->getName() == 'add.transactions') {

            TransactionService::crateFromData($this->source);
        }
        

      
    }
}
