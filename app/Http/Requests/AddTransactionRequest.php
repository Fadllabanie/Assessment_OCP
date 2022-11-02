<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => 'required|in:file,data',
            'file' => 'required_if:type,file',

            #################################

            // 'id' => ['required_if:type,data','unique:users,code'],
            // 'email' => 'required_if:type,data|email|unique:users,email',
            // 'balance' => 'required_if:type,data|numeric',
            // 'currency' => 'required_if:type,data|string',
            // 'created_at' => 'required_if:type,data|date',
        ];
    }
}
