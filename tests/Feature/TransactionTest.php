<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
    //   use RefreshDatabase;
    /**
     * @test
     */
    public function provider_can_add_transactions_using_json_file()
    {

        $file = public_path() . '/transactions.json';

        TransactionService::crateFromJsonFile($file);

        $transaction =  Transaction::where('parent_identification', 'd3d29d70-1d25-11e3-8591-034165a3a613')->first();

        $this->assertDatabaseHas('transactions', [
            'parent_email' => $transaction->parent_email
        ]);
        $this->assertDatabaseHas('transactions', [
            'parent_identification' => $transaction->parent_identification
        ]);
    }

    /**
     * @test
     */
    public function provider_can_display_transactions()
    {

        $transaction =  Transaction::get();

        // dd($transaction->count());
        $response = $this->get(route('display.transactions'));

        $this->assertEquals(18, $transaction->count());

        $response->assertStatus(200)
            ->assertJsonFragment([
                'status' => 1,
                "message" => "Success Request",
            ]);
    }
    /**
     * @test
     */
    public function provider_can_display_transactions_with_status_code_AUTHORIZED()
    {

        $transaction =  Transaction::where('status_code', Transaction::AUTHORIZED)->get();


        $response = $this->get(route('display.transactions'));

        $this->assertEquals(7, $transaction->count());

        $response->assertStatus(200)
            ->assertJsonFragment([
                'status' => 1,
                "message" => "Success Request",
            ]);
    }
}
