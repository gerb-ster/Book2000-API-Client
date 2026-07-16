<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Request;

use Book2000\ApiClient\Enum\Platform;

/**
 * Request body for POST /sales/register.
 *
 * Mirrors the "SaleRegisterRequest" schema from the OpenAPI definition.
 */
final class SaleRegisterRequest implements \JsonSerializable
{
    /**
     * @param Platform           $platform         Platform on which the sale happened.
     * @param int                $grossAmountCents Gross amount in cents (minimum 0).
     * @param int                $feeCents         Platform fee in cents (minimum 0).
     * @param string             $orderNumber      Order number (max 255 chars).
     * @param \DateTimeInterface $date             Date/time of the sale.
     * @param string             $customerName     Customer name (max 255 chars).
     * @param string|null        $customerEmail    Optional customer e-mail address.
     * @param string|null        $customerAddress  Optional customer address (max 2048 chars).
     */
    public function __construct(
        public readonly Platform $platform,
        public readonly int $grossAmountCents,
        public readonly int $feeCents,
        public readonly string $orderNumber,
        public readonly \DateTimeInterface $date,
        public readonly string $customerName,
        public readonly ?string $customerEmail = null,
        public readonly ?string $customerAddress = null,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [
            'platform' => $this->platform->value,
            'gross_amount_cents' => $this->grossAmountCents,
            'fee_cents' => $this->feeCents,
            'order_number' => $this->orderNumber,
            'date' => $this->date->format(\DateTimeInterface::ATOM),
            'customer_name' => $this->customerName,
        ];

        if ($this->customerEmail !== null) {
            $data['customer_email'] = $this->customerEmail;
        }

        if ($this->customerAddress !== null) {
            $data['customer_address'] = $this->customerAddress;
        }

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
