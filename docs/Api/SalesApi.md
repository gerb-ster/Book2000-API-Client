# Book2000\ApiClient\SalesApi



All URIs are relative to http://book.home:8488/api, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**salesRegister()**](SalesApi.md#salesRegister) | **POST** /sales/register | Register a sale |


## `salesRegister()`

```php
salesRegister($sale_register_request): \Book2000\ApiClient\Model\SalesRegister200Response
```

Register a sale

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Book2000\ApiClient\Api\SalesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
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

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
