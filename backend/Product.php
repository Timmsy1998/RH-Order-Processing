<?php

declare(strict_types=1);

class Product implements OrderItem
{
    public function __construct(
        protected string $name,
        protected float $price,
        protected int $quantity
    ) {
    }

    public function calculateTotal(): float
    {
        return $this->price * $this->quantity;
    }
}
