# Book2000 API Client

A **standalone**, dependency-free PHP client for the Book2000App API, generated from
the OpenAPI 3.1 definition in [`api.json`](./api.json).

It only relies on the `curl` and `json` PHP extensions and works without any framework.

## Requirements

- PHP >= 8.1
- `ext-curl`
- `ext-json`

## Installation

The package ships with PSR-4 autoloading. If you use Composer, install the
dependencies (only needed for the dev tooling) and rely on the generated autoloader:

```bash
composer install
```

Then include the autoloader in your application:

```php
require __DIR__ . '/vendor/autoload.php';
```

If you do not want to use Composer, register a simple PSR-4 autoloader for the
`Book2000\ApiClient\` namespace pointing at the `src/` directory.

## Usage

```php
use Book2000\ApiClient\Client;
use Book2000\ApiClient\Enum\PaymentMethod;
use Book2000\ApiClient\Enum\Platform;
use Book2000\ApiClient\Request\BatchRegisterRequest;
use Book2000\ApiClient\Request\LoginRequest;
use Book2000\ApiClient\Request\SaleRegisterRequest;
use Book2000\ApiClient\Exception\AuthenticationException;
use Book2000\ApiClient\Exception\ValidationException;

$client = new Client('http://book.home:8488/api');

// 1. Authenticate. The returned bearer token is stored on the client and
//    automatically sent with subsequent authenticated requests.
$token = $client->login(new LoginRequest('john', 'secret'));

// 2. Register a batch (Inkoop).
$batch = $client->registerBatch(new BatchRegisterRequest(
    description: "Partij 100 LP's Koningsdag",
    totalEuro: 200.00,
    purchaseDate: new DateTimeImmutable('2026-04-27'),
    paymentMethod: PaymentMethod::Bank,
));
echo "Transaction #{$batch->transactionId}\n";

// 3. Register a sale (Verkoop).
$sale = $client->registerSale(new SaleRegisterRequest(
    platform: Platform::Discogs,
    grossAmountCents: 2500,
    feeCents: 250,
    orderNumber: 'ORD-123',
    date: new DateTimeImmutable('2026-05-01'),
    customerName: 'Jane Doe',
    customerEmail: 'jane@example.com',       // optional
    customerAddress: 'Somewhere 1, City',    // optional
));
echo "Invoice {$sale->invoiceNumber} (#{$sale->invoiceId})\n";

// 4. Log out.
$client->logout();
```

### Error handling

Every non-2xx response is turned into an exception:

| HTTP status | Exception                                             |
|-------------|------------------------------------------------------|
| 401         | `Book2000\ApiClient\Exception\AuthenticationException` |
| 422         | `Book2000\ApiClient\Exception\ValidationException`     |
| other 4xx/5xx | `Book2000\ApiClient\Exception\ApiException`          |
| transport failure | `Book2000\ApiClient\Exception\NetworkException`   |

```php
try {
    $client->login(new LoginRequest('john', 'wrong-password'));
} catch (AuthenticationException $e) {
    echo "Invalid credentials: {$e->getMessage()}\n";
} catch (ValidationException $e) {
    foreach ($e->getErrors() as $field => $messages) {
        echo "{$field}: " . implode(', ', $messages) . "\n";
    }
}
```

### Reusing an existing token

```php
$client = new Client('http://book.home:8488/api', token: $storedToken);
// or later:
$client->setToken($storedToken);
```

### Custom transport

The client accepts any `Book2000\ApiClient\Http\HttpClientInterface`
implementation, which makes it easy to plug in a custom transport or a mock in
tests. By default a curl-based transport (`CurlHttpClient`) is used.

## Endpoints

| Method | Path                | Client method     |
|--------|---------------------|-------------------|
| POST   | `/auth/login`       | `login()`         |
| GET    | `/auth/logout`      | `logout()`        |
| POST   | `/batches/register` | `registerBatch()` |
| POST   | `/sales/register`   | `registerSale()`  |

See [`examples/usage.php`](./examples/usage.php) for a runnable example.
