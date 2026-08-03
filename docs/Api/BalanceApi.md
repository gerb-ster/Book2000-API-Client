# Book2000\ApiClient\BalanceApi



All URIs are relative to http://book2000.ootw.development/api, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**balanceAudit()**](BalanceApi.md#balanceAudit) | **POST** /balance/audit |  |


## `balanceAudit()`

```php
balanceAudit(): \Book2000\ApiClient\Model\BalanceAudit200Response
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: http
$config = Book2000\ApiClient\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Book2000\ApiClient\Api\BalanceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->balanceAudit();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BalanceApi->balanceAudit: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Book2000\ApiClient\Model\BalanceAudit200Response**](../Model/BalanceAudit200Response.md)

### Authorization

[http](../../README.md#http)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
