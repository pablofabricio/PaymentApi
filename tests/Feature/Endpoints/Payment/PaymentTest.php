<?php

namespace Tests\Feature\Endpoints\Payment;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $token;
    protected array $requestData;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('/rest/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->token = $response['access_token'];

        $this->requestData = [
            "transaction_amount" => 245.90,
            "installments" => 3,
            "token" => "ae4e50b2a8f3h6d9f2c3a4b5d6e7f8g9",
            "payment_method_id" => "master",
            "payer" => [
                "email" => "example_random@gmail.com",
                "identification" => [
                    "type" => "CPF",
                    "number" => "12345678909"
                ]
            ]
        ];
    }

    public function testGetAllPayments()
    {
        Payment::factory()->count(3)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->get('/rest/payments');

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure([
                    '*' => [
                        "id",
                        "status",
                        "transaction_amount",
                        "installments",
                        "token",
                        "payment_method_id",
                        "payer",
                        "notification_url",
                        "created_at",
                        "updated_at",
                    ]
                ]);
    }

    public function testGetPaymentById()
    {
        $payment = Payment::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->get('/rest/payments/' . $payment->id);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertEquals($payment->id, $response['id']);
    }

    public function testDeletePayment()
    {
        $payment = Payment::factory()->create(['status' => 'PENDING']);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->delete('/rest/payments/'.$payment->id);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertEquals('CANCELED', Payment::find($payment->id)->status);
    }

    public function testConfirmPayment()
    {
        $payment = Payment::factory()->create(['status' => 'PENDING']);
    
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->patch('/rest/payments/'.$payment->id);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertEquals('PAID', Payment::find($payment->id)->status);
    }

    public function testCreatePayment()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->postJson('/rest/payments', $this->requestData);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
            'id', 
            'created_at'
        ]);
    }

    public function testCreatePaymentWithoutAuthentication()
    {
        $response = $this->postJson('/rest/payments', $this->requestData);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
