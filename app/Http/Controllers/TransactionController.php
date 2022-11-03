<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Interface\ReadFactory;
use App\Http\Requests\AddTransactionRequest;
use App\Http\Resources\Transactions\TransactionCollection;

class TransactionController extends Controller
{
    const TYPE_OF_REQUEST_FILE = 'file';
    const TYPE_OF_REQUEST_DATA = 'data';

    public function add(AddTransactionRequest $request)
    {

        $readerFactory = new ReadFactory();


        if ($request->type == TransactionController::TYPE_OF_REQUEST_FILE) {

            $readerFactory->initialize('json-file', $request->file);
        } elseif ($request->type == TransactionController::TYPE_OF_REQUEST_DATA) {

            $readerFactory->initialize('http-request', $request);
        }

        return $this->respondCreated();
    }

    public function display(Request $request)
    {
        return new TransactionCollection(
            Transaction::with(['user'])
                ->whereHas('userEmail')

                ->when($request->status, function ($query) use ($request) {
                    $query->status($request->status);
                })
                ->when($request->currencies and $request->currencies[0] != null, function ($query) use ($request) {
                    $query->whereIn('currency', [$request->currencies]);
                })
                ->when($request->from_amount and $request->to_amount, function ($query) use ($request) {
                    $query->whereBetween('paid_amount', [$request->from_amount, $request->to_amount]);
                })
                ->when($request->from_date and $request->to_date, function ($query) use ($request) {
                    $query->whereBetween('payment_date', [$request->from_date, $request->to_date]);
                })
                ->get()
        );
    }
}
