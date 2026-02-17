<?php

declare(strict_types=1);

class PhysicalProduct extends Product
{
    public function __construct(
        string $name,
        float $price,
        int $quantity,
        private float $weight
    ) {
        parent::__construct($name, $price, $quantity);
    }

    public function calculateTotal(): float
    {
        return $this->baseTotal() * $this->weight;
    }
}
