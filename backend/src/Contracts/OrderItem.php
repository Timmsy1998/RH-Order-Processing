<?php

declare(strict_types=1);

namespace App\Contracts;

interface OrderItem
{
    public function calculateTotal(): float;
}
