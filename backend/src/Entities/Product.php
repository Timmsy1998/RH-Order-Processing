<?php

declare(strict_types=1);

namespace App\Entities;

use App\Contracts\OrderItem;

class Product implements OrderItem
{
    public function __construct(
        private string $name,
        private float $price,
        private int $quantity
    ) {
    }

    public function calculateTotal(): float
    {
        return $this->baseTotal();
    }

    protected function baseTotal(): float
    {
        return $this->price * $this->quantity;
    }
}
