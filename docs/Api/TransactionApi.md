# Book2000\ApiClient\TransactionApi



All URIs are relative to http://book2000.ootw.development/api, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**transactionRegister()**](TransactionApi.md#transactionRegister) | **POST** /transactions/register | Register a new transaction, its journal entries and an optional invoice |


## `transactionRegister()`

```php
transactionRegister($transaction_register_request): \Book2000\ApiClient\Model\TransactionRegister200Response
```

Register a new transaction, its journal entries and an optional invoice

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Book2000\ApiClient\Api\TransactionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$transaction_register_request = new \Book2000\ApiClient\Model\TransactionRegisterRequest(); // \Book2000\ApiClient\Model\TransactionRegisterRequest

try {
    $result = $apiInstance->transactionRegister($transaction_register_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TransactionApi->transactionRegister: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **transaction_register_request** | [**\Book2000\ApiClient\Model\TransactionRegisterRequest**](../Model/TransactionRegisterRequest.md)|  | |

### Return type

[**\Book2000\ApiClient\Model\TransactionRegister200Response**](../Model/TransactionRegister200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
