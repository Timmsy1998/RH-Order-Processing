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

## Frontend (Vue 3)

I implemented the frontend as a simple order manager UI using Vue 3 Composition API. The form lets me choose a product type, enter product details, add the product to an order, and see a live order summary.

### Frontend structure

```text
frontend/
  index.html
  package.json
  tailwind.config.js
  postcss.config.js
  vite.config.ts
  tsconfig.json
  tsconfig.node.json
  public/
    vite.svg
  src/
    App.vue
    main.ts
    orderClasses.js
    style.css
    vite-env.d.ts
    assets/
      vue.svg
    components/
      HelloWorld.vue
```

### What I implemented

1. Add product flow:
   - Implemented `addProduct` to create a product instance from form data.
   - Uses the selected product type to instantiate:
     - `DigitalProduct`
     - `PhysicalProduct`
     - `SubscriptionProduct`
   - Adds the product to the order and resets form inputs.
   - Shows a basic error message for invalid product details.
2. Current order product list:
   - Renders products reactively under the order total.
   - Displays each product name and price.
   - Shows an empty-state message when no products are added.
3. Reactive order total:
   - Implemented `orderTotal` as a computed property.
   - Uses the order model's `calculateTotal()` and updates automatically when products are added.

### Why I did it this way

1. I used Composition API with `ref` and `computed` to keep state and derived values explicit.
2. I reused the provided class models in `orderClasses.js` so the frontend behavior matches the OOP rules from the backend exercise.
3. I kept UI logic in `App.vue` focused on orchestration, while product pricing logic stays in the model classes.

### How to run the frontend

From the project root:

```bash
cd frontend
npm install
npm run dev
```

Then open the local Vite URL shown in the terminal.
