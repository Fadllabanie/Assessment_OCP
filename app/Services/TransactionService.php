<?php

namespace App\Services;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{

    public static function crateFromData($data)
    {

        $data->validate([
            'parentIdentification' => 'required',
            'parentEmail' => 'required|email|unique:users,email',
            'statusCode' => 'required|numeric',
            'paidAmount' => 'required|numeric',
            'Currency' => 'required|string',
            'paymentDate' => 'required|date',
        ]);

        DB::table('transactions')->insert([
            'parent_identification' => $data->parentIdentification,
            'parent_email' =>  $data->parentEmail,
            'paid_amount' =>  $data->paidAmount,
            'currency' => $data->Currency,
            'status_code' => $data->statusCode,
            'payment_date' => $data->paymentDate,
        ]);
    }
    public static function crateFromJsonFile($file)
    {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $response = file_get_contents($file, false, stream_context_create($arrContextOptions));

        $json_data = json_decode($response);


        foreach ($json_data->transactions as $transaction) {

            Transaction::updateOrCreate(
                [
                    'parent_identification' => $transaction->parentIdentification,
                    'parent_email' =>  $transaction->parentEmail,
                    'parent_id' =>  DB::table('users')->where('email', $transaction->parentEmail)->value('id'),
                ],
                [

                    'paid_amount' =>  $transaction->paidAmount,
                    'currency' => $transaction->Currency,
                    'status_code' => $transaction->statusCode,
                    'payment_date' => $transaction->paymentDate,
                ]
            );
        }
    }
}
