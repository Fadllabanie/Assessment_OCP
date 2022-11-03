<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{

    public static function crateFromData($data)
    {

        $data->validate([
            'id' => 'required_if:type,data', 'unique:users,code',
            'email' => 'required_if:type,data|email|unique:users,email',
            'balance' => 'required_if:type,data|numeric',
            'currency' => 'required_if:type,data|string',
            'created_at' => 'required_if:type,data|date',
        ]);

        DB::table('users')->insert([
            'code' => $data->id,
            'email' =>  $data['email'],
            'balance' =>  $data['balance'],
            'currency' => $data['currency'],
            'created_at' => $data['created_at'],
            'updated_at' => now()
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

        foreach ($json_data->users as $user) {

            User::updateOrCreate(
                [
                    'code' => $user->id,
                    'email' =>  $user->email,
                ],
                [

                    'balance' =>  $user->balance,
                    'currency' => $user->currency,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
