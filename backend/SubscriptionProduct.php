<?php

declare(strict_types=1);

class SubscriptionProduct extends Product
{
    public function __construct(
        string $name,
        float $price,
        int $quantity,
        private int $subscriptionDuration
    ) {
        parent::__construct($name, $price, $quantity);
    }
}
