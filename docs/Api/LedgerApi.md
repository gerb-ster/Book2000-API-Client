# Book2000\ApiClient\LedgerApi



All URIs are relative to http://book2000.ootw.development/api, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**ledgerIndex()**](LedgerApi.md#ledgerIndex) | **GET** /ledgers | List active ledger accounts, optionally filtered by a search term and ledger type |


## `ledgerIndex()`

```php
ledgerIndex($search, $type, $category): \Book2000\ApiClient\Model\LedgerIndex200Response
```

List active ledger accounts, optionally filtered by a search term and ledger type

The search term is matched against the ledger code, name, category, and RGS code. The type filter accepts `debit` or `credit`; the category filter accepts `balance` or `profit_loss`. Results are sorted by ledger code.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: http
$config = Book2000\ApiClient\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Book2000\ApiClient\Api\LedgerApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$search = 'search_example'; // string
$type = new \Book2000\ApiClient\Model\\Book2000ApiClientModelLedgerType(); // \Book2000ApiClientModelLedgerType
$category = new \Book2000\ApiClient\Model\\Book2000ApiClientModelLedgerCategory(); // \Book2000ApiClientModelLedgerCategory

try {
    $result = $apiInstance->ledgerIndex($search, $type, $category);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LedgerApi->ledgerIndex: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **search** | **string**|  | [optional] |
| **type** | [**\Book2000ApiClientModelLedgerType**](../Model/.md)|  | [optional] |
| **category** | [**\Book2000ApiClientModelLedgerCategory**](../Model/.md)|  | [optional] |

### Return type

[**\Book2000\ApiClient\Model\LedgerIndex200Response**](../Model/LedgerIndex200Response.md)

### Authorization

[http](../../README.md#http)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
