# Book2000\ApiClient\AuthenticateApi



All URIs are relative to http://book.home:8488/api, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**authenticateLogin()**](AuthenticateApi.md#authenticateLogin) | **POST** /auth/login |  |
| [**authenticateLogout()**](AuthenticateApi.md#authenticateLogout) | **GET** /auth/logout |  |


## `authenticateLogin()`

```php
authenticateLogin($login_request): \Book2000\ApiClient\Model\AuthenticateLogin200Response
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Book2000\ApiClient\Api\AuthenticateApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$login_request = new \Book2000\ApiClient\Model\LoginRequest(); // \Book2000\ApiClient\Model\LoginRequest

try {
    $result = $apiInstance->authenticateLogin($login_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthenticateApi->authenticateLogin: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **login_request** | [**\Book2000\ApiClient\Model\LoginRequest**](../Model/LoginRequest.md)|  | |

### Return type

[**\Book2000\ApiClient\Model\AuthenticateLogin200Response**](../Model/AuthenticateLogin200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `authenticateLogout()`

```php
authenticateLogout(): object
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Book2000\ApiClient\Api\AuthenticateApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->authenticateLogout();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthenticateApi->authenticateLogout: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

**object**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
