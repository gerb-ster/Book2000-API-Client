# Book2000\ApiClient\BatchApi



All URIs are relative to http://book2000.ootw.development/api, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**batchRegister()**](BatchApi.md#batchRegister) | **POST** /batches/register | Register a batch |


## `batchRegister()`

```php
batchRegister($batch_register_request): \Book2000\ApiClient\Model\BatchRegister200Response
```

Register a batch

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Book2000\ApiClient\Api\BatchApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$batch_register_request = new \Book2000\ApiClient\Model\BatchRegisterRequest(); // \Book2000\ApiClient\Model\BatchRegisterRequest

try {
    $result = $apiInstance->batchRegister($batch_register_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BatchApi->batchRegister: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **batch_register_request** | [**\Book2000\ApiClient\Model\BatchRegisterRequest**](../Model/BatchRegisterRequest.md)|  | |

### Return type

[**\Book2000\ApiClient\Model\BatchRegister200Response**](../Model/BatchRegister200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
