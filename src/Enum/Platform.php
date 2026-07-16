<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Enum;

/**
 * Sales platforms supported when registering a sale.
 *
 * Mirrors the "Platforms" schema from the OpenAPI definition.
 */
enum Platform: string
{
    case Marktplaats = 'marktplaats';
    case Vinted = 'vinted';
    case Discogs = 'discogs';
    case Direct = 'direct';
    case Other = 'other';
}
