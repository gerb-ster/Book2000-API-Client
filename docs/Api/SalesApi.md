# Book2000\ApiClient\SalesApi



All URIs are relative to http://book2000.ootw.development/api, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**salesRegister()**](SalesApi.md#salesRegister) | **POST** /sales/register | Register a sale |
| [**salesReturn()**](SalesApi.md#salesReturn) | **POST** /sales/return |  |


## `salesRegister()`

```php
salesRegister($sale_register_request): \Book2000\ApiClient\Model\SalesRegister200Response
```

Register a sale

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: http
$config = Book2000\ApiClient\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Book2000\ApiClient\Api\SalesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sale_register_request = new \Book2000\ApiClient\Model\SaleRegisterRequest(); // \Book2000\ApiClient\Model\SaleRegisterRequest

try {
    $result = $apiInstance->salesRegister($sale_register_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesApi->salesRegister: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sale_register_request** | [**\Book2000\ApiClient\Model\SaleRegisterRequest**](../Model/SaleRegisterRequest.md)|  | |

### Return type

[**\Book2000\ApiClient\Model\SalesRegister200Response**](../Model/SalesRegister200Response.md)

### Authorization

[http](../../README.md#http)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `salesReturn()`

```php
salesReturn($sale_return_request): \Book2000\ApiClient\Model\SalesReturn200Response
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: http
$config = Book2000\ApiClient\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Book2000\ApiClient\Api\SalesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sale_return_request = new \Book2000\ApiClient\Model\SaleReturnRequest(); // \Book2000\ApiClient\Model\SaleReturnRequest

try {
    $result = $apiInstance->salesReturn($sale_return_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesApi->salesReturn: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sale_return_request** | [**\Book2000\ApiClient\Model\SaleReturnRequest**](../Model/SaleReturnRequest.md)|  | |

### Return type

[**\Book2000\ApiClient\Model\SalesReturn200Response**](../Model/SalesReturn200Response.md)

### Authorization

[http](../../README.md#http)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
