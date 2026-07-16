<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Tests;

use Book2000\ApiClient\Client;
use Book2000\ApiClient\Enum\PaymentMethod;
use Book2000\ApiClient\Enum\Platform;
use Book2000\ApiClient\Exception\ApiException;
use Book2000\ApiClient\Exception\AuthenticationException;
use Book2000\ApiClient\Exception\ValidationException;
use Book2000\ApiClient\Http\HttpResponse;
use Book2000\ApiClient\Request\BatchRegisterRequest;
use Book2000\ApiClient\Request\LoginRequest;
use Book2000\ApiClient\Request\SaleRegisterRequest;
use Book2000\ApiClient\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    public function testLoginReturnsAndStoresToken(): void
    {
        $transport = new MockHttpClient([
            new HttpResponse(200, json_encode([
                'success' => true,
                'data' => 'tok123',
                'message' => 'User login successfully.',
            ])),
        ]);
        $client = new Client('http://x/api', $transport);

        $token = $client->login(new LoginRequest('john', 'secret'));

        self::assertSame('tok123', $token);
        self::assertSame('tok123', $client->getToken());

        $call = $transport->lastCall();
        self::assertSame('POST', $call['method']);
        self::assertSame('http://x/api/auth/login', $call['url']);
        self::assertSame('application/json', $call['headers']['Content-Type']);
        self::assertSame(['username' => 'john', 'password' => 'secret'], json_decode((string) $call['body'], true));
    }

    public function testRegisterBatchSendsBearerAndSerializesPayload(): void
    {
        $transport = new MockHttpClient([
            new HttpResponse(200, json_encode([
                'success' => true,
                'data' => ['transaction_id' => 42],
                'message' => 'ok',
            ])),
        ]);
        $client = new Client('http://x/api', $transport, 'abc');

        $result = $client->registerBatch(new BatchRegisterRequest(
            description: "Partij 100 LP's",
            totalEuro: 200.0,
            purchaseDate: new \DateTimeImmutable('2026-04-27T10:00:00+00:00'),
            paymentMethod: PaymentMethod::Bank,
        ));

        self::assertSame(42, $result->transactionId);

        $call = $transport->lastCall();
        self::assertSame('Bearer abc', $call['headers']['Authorization']);

        $body = json_decode((string) $call['body'], true);
        self::assertSame('bank', $body['payment_method']);
        self::assertEquals(200.0, $body['total_euro']);
        self::assertStringContainsString('2026-04-27', $body['purchase_date']);
    }

    public function testRegisterSaleOmitsNullOptionalFields(): void
    {
        $transport = new MockHttpClient([
            new HttpResponse(200, json_encode([
                'success' => true,
                'data' => ['invoice_id' => 7, 'invoice_number' => 'INV-7'],
                'message' => 'ok',
            ])),
        ]);
        $client = new Client('http://x/api', $transport, 'abc');

        $result = $client->registerSale(new SaleRegisterRequest(
            platform: Platform::Discogs,
            grossAmountCents: 2500,
            feeCents: 250,
            orderNumber: 'ORD-123',
            date: new \DateTimeImmutable('2026-05-01T00:00:00+00:00'),
            customerName: 'Jane Doe',
        ));

        self::assertSame(7, $result->invoiceId);
        self::assertSame('INV-7', $result->invoiceNumber);

        $body = json_decode((string) $transport->lastCall()['body'], true);
        self::assertArrayNotHasKey('customer_email', $body);
        self::assertArrayNotHasKey('customer_address', $body);
        self::assertSame('discogs', $body['platform']);
    }

    public function testLogoutClearsToken(): void
    {
        $transport = new MockHttpClient([new HttpResponse(200, json_encode(new \stdClass()))]);
        $client = new Client('http://x/api', $transport, 'abc');

        $client->logout();

        self::assertNull($client->getToken());
        self::assertSame('GET', $transport->lastCall()['method']);
        self::assertSame('http://x/api/auth/logout', $transport->lastCall()['url']);
    }

    public function testUnauthorisedThrowsAuthenticationException(): void
    {
        $transport = new MockHttpClient([
            new HttpResponse(401, json_encode([
                'success' => false,
                'message' => 'Unauthorised.',
                'data' => ['error' => 'Unauthorised'],
            ])),
        ]);
        $client = new Client('http://x/api', $transport);

        $this->expectException(AuthenticationException::class);
        $client->login(new LoginRequest('john', 'wrong'));
    }

    public function testValidationErrorThrowsValidationException(): void
    {
        $transport = new MockHttpClient([
            new HttpResponse(422, json_encode([
                'message' => 'The given data was invalid.',
                'errors' => ['username' => ['The username field is required.']],
            ])),
        ]);
        $client = new Client('http://x/api', $transport);

        try {
            $client->login(new LoginRequest('', ''));
            self::fail('Expected ValidationException was not thrown.');
        } catch (ValidationException $e) {
            self::assertSame(422, $e->getStatusCode());
            self::assertSame(['The username field is required.'], $e->getErrors()['username']);
        }
    }

    public function testServerErrorThrowsApiException(): void
    {
        $transport = new MockHttpClient([
            new HttpResponse(500, json_encode([
                'success' => false,
                'message' => 'Something went wrong.',
                'data' => [],
            ])),
        ]);
        $client = new Client('http://x/api', $transport, 'abc');

        $this->expectException(ApiException::class);
        $client->registerBatch(new BatchRegisterRequest(
            description: 'x',
            totalEuro: 1.0,
            purchaseDate: new \DateTimeImmutable('2026-04-27T00:00:00+00:00'),
            paymentMethod: PaymentMethod::Cash,
        ));
    }
}
