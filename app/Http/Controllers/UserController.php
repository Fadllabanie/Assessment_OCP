<?php

namespace App\Http\Controllers;

use App\Interface\ReadFactory;
use App\Http\Requests\AddUserRequest;
use Illuminate\Http\Client\Request;

class UserController extends Controller
{
    const TYPE_OF_REQUEST_FILE = 'file';
    const TYPE_OF_REQUEST_DATA = 'data';

    public function add(AddUserRequest $request)
    {
      
        $readerFactory = new ReadFactory();


        if ($request->type == UserController::TYPE_OF_REQUEST_FILE) {

            $readerFactory->initialize('json-file', $request->file);
            
        } elseif ($request->type == UserController::TYPE_OF_REQUEST_DATA) {

            $readerFactory->initialize('http-request', $request);
        }

       return $this->respondCreated();
    }

  
}
