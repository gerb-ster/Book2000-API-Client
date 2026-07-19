# TransactionRegisterRequestInvoice

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**contact_id** | **int** |  | [optional]
**type** | **string** |  | [optional]
**invoice_reference** | **string** |  | [optional]
**invoice_date** | **\DateTime** |  | [optional]
**due_date** | **\DateTime** |  | [optional]
**subtotal_cents** | **int** |  | [optional]
**vat_cents** | **int** |  | [optional]
**total_cents** | **int** |  | [optional]
**status** | **string** |  | [optional]
**items** | [**\Book2000\ApiClient\Model\TransactionRegisterRequestInvoiceItemsInner[]**](TransactionRegisterRequestInvoiceItemsInner.md) | The optional invoice items (required as soon as an invoice is passed). | [optional]
**attachments** | [**\Book2000\ApiClient\Model\TransactionRegisterRequestInvoiceAttachmentsInner[]**](TransactionRegisterRequestInvoiceAttachmentsInner.md) | Optional invoice attachments, sent as one or more base64 encoded files. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
