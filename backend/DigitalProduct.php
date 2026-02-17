<?php

declare(strict_types=1);

class DigitalProduct extends Product
{
    public function __construct(
        string $name,
        float $price,
        int $quantity,
        private string $downloadLink
    ) {
        parent::__construct($name, $price, $quantity);
    }
}
