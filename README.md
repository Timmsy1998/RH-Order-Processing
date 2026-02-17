# RH-Order-Processing

## Backend (PHP)

I built this backend as a small OOP order processing exercise. The goal was to support multiple product types and calculate a single order total while keeping the code easy to extend.

### Folder structure

```text
backend/
  demo.php
  src/
    Contracts/
      OrderItem.php
    Entities/
      Product.php
      DigitalProduct.php
      PhysicalProduct.php
      SubscriptionProduct.php
      Order.php
```

I split the code into `Contracts` and `Entities` so responsibilities stay clear as the project grows.

### Why I designed it this way

1. I introduced `OrderItem` as a contract so `Order` depends on behavior (`calculateTotal`) instead of concrete classes.
2. I made `Product` the base class for shared state and default total logic (`price * quantity`).
3. I extended `Product` for specialized behavior:
   - `PhysicalProduct` overrides total logic to include weight (`price * quantity * weight`).
   - `DigitalProduct` adds a `downloadLink`.
   - `SubscriptionProduct` adds `subscriptionDuration`.
4. I kept properties encapsulated with `private`/`protected` access and avoided public getters/setters for product fields, based on the task constraints.
5. I avoided branching by product type in `Order`. It loops over items and calls `calculateTotal()` polymorphically.

### How to run the demo

From the project root:

```bash
php backend/demo.php
```

Expected output:

```text
Order Total: 128.50
```
