<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Request;

use Book2000\ApiClient\Enum\PaymentMethod;

/**
 * Request body for POST /batches/register.
 *
 * Mirrors the "BatchRegisterRequest" schema from the OpenAPI definition.
 */
final class BatchRegisterRequest implements \JsonSerializable
{
    /**
     * @param string             $description  Description of the batch, e.g. "Partij 100 LP's Koningsdag" (max 1024 chars).
     * @param float              $totalEuro    Total amount in euro, e.g. 200.00 (minimum 0.01).
     * @param \DateTimeInterface $purchaseDate Date/time the batch was purchased.
     * @param PaymentMethod      $paymentMethod How the batch was paid for.
     */
    public function __construct(
        public readonly string $description,
        public readonly float $totalEuro,
        public readonly \DateTimeInterface $purchaseDate,
        public readonly PaymentMethod $paymentMethod,
    ) {
    }

    /**
     * @return array{description: string, total_euro: float, purchase_date: string, payment_method: string}
     */
    public function toArray(): array
    {
        return [
            'description' => $this->description,
            'total_euro' => $this->totalEuro,
            'purchase_date' => $this->purchaseDate->format(\DateTimeInterface::ATOM),
            'payment_method' => $this->paymentMethod->value,
        ];
    }

    /**
     * @return array{description: string, total_euro: float, purchase_date: string, payment_method: string}
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
