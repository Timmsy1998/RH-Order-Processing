<?php

declare(strict_types=1);

interface OrderItem
{
    public function calculateTotal(): float;
}
