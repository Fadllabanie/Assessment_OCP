<?php

namespace App\Http\Traits;

trait ApiResponder
{

    protected $statusCode = 200;
    protected $success = 1;
    protected $failure = 0;

    /**
     * Getter for statusCode
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    } 
     /**
     * Getter for statusCode
     *
     * @return int
     */
    public function getSuccess()
    {
        return $this->success;
    }
  

    /**
     * Setter for statusCode
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    protected function respond($data, $headers = [])
    {
        return response()->json($data, $this->statusCode, $headers);
    }


    public function respondCreated($message = 'Resource created successfully')
    {
        return $this->setStatusCode(201)
            ->respond([
                'status' => $this->getSuccess(),
                'message' => $message,
                //'data' => $data,
               
            ]);
    }


}
