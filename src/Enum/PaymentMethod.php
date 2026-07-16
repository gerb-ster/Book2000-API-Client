<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Enum;

/**
 * Payment methods accepted when registering a batch.
 *
 * Mirrors the "PaymentMethod" schema from the OpenAPI definition.
 */
enum PaymentMethod: string
{
    case Cash = 'cash';
    case Bank = 'bank';
    case Invoice = 'invoice';
}
