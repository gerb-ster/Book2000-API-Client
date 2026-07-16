<?php

declare(strict_types=1);

/**
 * Runnable example for the Book2000 API client.
 *
 * Usage:
 *   php examples/usage.php <base-uri> <username> <password>
 *
 * Example:
 *   php examples/usage.php http://book.home:8488/api john secret
 */

use Book2000\ApiClient\Client;
use Book2000\ApiClient\Enum\PaymentMethod;
use Book2000\ApiClient\Enum\Platform;
use Book2000\ApiClient\Exception\ApiException;
use Book2000\ApiClient\Exception\AuthenticationException;
use Book2000\ApiClient\Exception\ValidationException;
use Book2000\ApiClient\Request\BatchRegisterRequest;
use Book2000\ApiClient\Request\LoginRequest;
use Book2000\ApiClient\Request\SaleRegisterRequest;

// Prefer the Composer autoloader when available, otherwise fall back to a
// minimal PSR-4 autoloader so the example runs without Composer.
$composerAutoload = __DIR__ . '/../vendor/autoload.php';
if (is_file($composerAutoload)) {
    require $composerAutoload;
} else {
    spl_autoload_register(static function (string $class): void {
        $prefix = 'Book2000\\ApiClient\\';
        if (!str_starts_with($class, $prefix)) {
            return;
        }

        $relative = substr($class, strlen($prefix));
        $file = __DIR__ . '/../src/' . str_replace('\\', '/', $relative) . '.php';

        if (is_file($file)) {
            require $file;
        }
    });
}

$baseUri = $argv[1] ?? 'http://book.home:8488/api';
$username = $argv[2] ?? 'demo';
$password = $argv[3] ?? 'demo';

$client = new Client($baseUri);

try {
    $token = $client->login(new LoginRequest($username, $password));
    echo "Logged in, token: {$token}\n";

    $batch = $client->registerBatch(new BatchRegisterRequest(
        description: "Partij 100 LP's Koningsdag",
        totalEuro: 200.00,
        purchaseDate: new DateTimeImmutable('2026-04-27'),
        paymentMethod: PaymentMethod::Bank,
    ));
    echo "Batch registered, transaction #{$batch->transactionId}\n";

    $sale = $client->registerSale(new SaleRegisterRequest(
        platform: Platform::Discogs,
        grossAmountCents: 2500,
        feeCents: 250,
        orderNumber: 'ORD-123',
        date: new DateTimeImmutable('2026-05-01'),
        customerName: 'Jane Doe',
        customerEmail: 'jane@example.com',
    ));
    echo "Sale registered, invoice {$sale->invoiceNumber} (#{$sale->invoiceId})\n";

    $client->logout();
    echo "Logged out.\n";
} catch (ValidationException $e) {
    fwrite(STDERR, "Validation failed: {$e->getMessage()}\n");
    foreach ($e->getErrors() as $field => $messages) {
        fwrite(STDERR, "  {$field}: " . implode(', ', $messages) . "\n");
    }
    exit(1);
} catch (AuthenticationException $e) {
    fwrite(STDERR, "Authentication failed: {$e->getMessage()}\n");
    exit(1);
} catch (ApiException $e) {
    fwrite(STDERR, "API error ({$e->getStatusCode()}): {$e->getMessage()}\n");
    exit(1);
}
