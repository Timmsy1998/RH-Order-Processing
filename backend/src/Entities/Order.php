<?php

declare(strict_types=1);

namespace App\Entities;

use App\Contracts\OrderItem;

class Order
{
    /** @var OrderItem[] */
    private array $products = [];

    public function addProduct(OrderItem $product): void
    {
        $this->products[] = $product;
    }

    public function calculateTotalAmount(): float
    {
        $total = 0.0;

        foreach ($this->products as $product) {
            $total += $product->calculateTotal();
        }

        return $total;
    }
}
