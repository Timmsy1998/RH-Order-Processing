<?php

declare(strict_types=1);

require_once __DIR__ . '/src/Contracts/OrderItem.php';
require_once __DIR__ . '/src/Entities/Product.php';
require_once __DIR__ . '/src/Entities/DigitalProduct.php';
require_once __DIR__ . '/src/Entities/PhysicalProduct.php';
require_once __DIR__ . '/src/Entities/SubscriptionProduct.php';
require_once __DIR__ . '/src/Entities/Order.php';

use App\Entities\DigitalProduct;
use App\Entities\Order;
use App\Entities\PhysicalProduct;
use App\Entities\SubscriptionProduct;

$order = new Order();
$order->addProduct(new DigitalProduct('Ebook', 15.00, 2, 'https://example.com/download/ebook'));
$order->addProduct(new PhysicalProduct('Keyboard', 25.00, 1, 2.5));
$order->addProduct(new SubscriptionProduct('Streaming Plan', 12.00, 3, 6));

echo 'Order Total: ' . number_format($order->calculateTotalAmount(), 2) . PHP_EOL;
