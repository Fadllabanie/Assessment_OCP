<?php

namespace App\Interface;

use Illuminate\Support\Str;
use App\Services\UserService;
use App\Interface\ReadableInterface;
use App\Services\TransactionService;


class JsonFile implements ReadableInterface
{

    public $source;

    public function __construct($source)
    {
        $this->source = $source;
    }

    public function read()
    {

        if (Str::contains($this->source->getClientOriginalName(), 'users')) {

            UserService::crateFromJsonFile($this->source);

        } elseif (Str::contains($this->source->getClientOriginalName(), 'transactions')) {

            TransactionService::crateFromJsonFile($this->source);
        }
    }
}
