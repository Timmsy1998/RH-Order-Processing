<template>
  <div
    class="relative mx-auto max-w-5xl px-5 pb-14 pt-10 [font-family:'Manrope','Segoe_UI','Trebuchet_MS',sans-serif] sm:px-6 sm:pt-12"
  >
    <div
      class="pointer-events-none absolute -left-16 -top-24 -z-10 h-80 w-80 animate-pulse rounded-full bg-sky-400/40 blur-3xl"
    ></div>
    <div
      class="pointer-events-none absolute -right-20 top-56 -z-10 h-80 w-80 animate-pulse rounded-full bg-teal-300/40 blur-3xl [animation-delay:600ms]"
    ></div>

    <header class="mb-6">
      <p class="mb-1 text-[0.72rem] font-extrabold uppercase tracking-[0.15em] text-slate-600">
        Order Processing
      </p>
      <h1
        class="m-0 text-[clamp(1.8rem,4vw,2.5rem)] font-bold leading-[1.05] tracking-[-0.02em] [font-family:'Space_Grotesk','Segoe_UI',sans-serif]"
      >
        Order Manager
      </h1>
      <p class="mt-2 max-w-2xl text-slate-700">
        Build an order with digital, physical, and subscription products.
      </p>
    </header>

    <form
      @submit.prevent="addProduct"
      class="mb-4 rounded-2xl border border-white/90 bg-white/80 p-5 shadow-[0_12px_28px_rgba(16,24,40,0.08)] backdrop-blur md:p-6"
    >
      <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <div class="mb-3.5">
        <label
          class="mb-1.5 block text-[0.8rem] font-bold text-slate-700"
          for="productType"
        >
          Product Type
        </label>
        <select
          v-model="productType"
          id="productType"
          class="w-full rounded-xl border border-slate-300 bg-white/90 px-3 py-2.5 text-[0.95rem] text-slate-900 transition focus:border-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-700/15"
        >
          <option value="digital">Digital</option>
          <option value="physical">Physical</option>
          <option value="subscription">Subscription</option>
        </select>
      </div>

      <div class="mb-3.5">
        <label
          class="mb-1.5 block text-[0.8rem] font-bold text-slate-700"
          for="productName"
        >
          Product Name
        </label>
        <input
          v-model="productName"
          id="productName"
          type="text"
          class="w-full rounded-xl border border-slate-300 bg-white/90 px-3 py-2.5 text-[0.95rem] text-slate-900 transition focus:border-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-700/15"
          required
        />
      </div>

      <div class="mb-3.5">
        <label
          class="mb-1.5 block text-[0.8rem] font-bold text-slate-700"
          for="productPrice"
        >
          Price
        </label>
        <input
          v-model="productPrice"
          id="productPrice"
          type="number"
          step="0.01"
          class="w-full rounded-xl border border-slate-300 bg-white/90 px-3 py-2.5 text-[0.95rem] text-slate-900 transition focus:border-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-700/15"
          required
        />
      </div>

      <div class="mb-3.5">
        <label
          class="mb-1.5 block text-[0.8rem] font-bold text-slate-700"
          for="productQuantity"
        >
          Quantity
        </label>
        <input
          v-model="productQuantity"
          id="productQuantity"
          type="number"
          class="w-full rounded-xl border border-slate-300 bg-white/90 px-3 py-2.5 text-[0.95rem] text-slate-900 transition focus:border-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-700/15"
          required
        />
      </div>
      </div>

      <div v-if="productType === 'digital'" class="mb-3.5">
        <label
          class="mb-1.5 block text-[0.8rem] font-bold text-slate-700"
          for="downloadLink"
        >
          Download Link
        </label>
        <input
          v-model="downloadLink"
          id="downloadLink"
          type="url"
          class="w-full rounded-xl border border-slate-300 bg-white/90 px-3 py-2.5 text-[0.95rem] text-slate-900 transition focus:border-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-700/15"
        />
      </div>

      <div v-if="productType === 'physical'" class="mb-3.5">
        <label class="mb-1.5 block text-[0.8rem] font-bold text-slate-700" for="weight">
          Weight
        </label>
        <input
          v-model="weight"
          id="weight"
          type="number"
          step="0.01"
          class="w-full rounded-xl border border-slate-300 bg-white/90 px-3 py-2.5 text-[0.95rem] text-slate-900 transition focus:border-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-700/15"
        />
      </div>

      <div v-if="productType === 'subscription'" class="mb-3.5">
        <label
          class="mb-1.5 block text-[0.8rem] font-bold text-slate-700"
          for="subscriptionDuration"
        >
          Subscription Duration (months)
        </label>
        <input
          v-model="subscriptionDuration"
          id="subscriptionDuration"
          type="number"
          class="w-full rounded-xl border border-slate-300 bg-white/90 px-3 py-2.5 text-[0.95rem] text-slate-900 transition focus:border-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-700/15"
        />
      </div>

      <div class="mt-2">
        <button
          type="submit"
          class="rounded-xl bg-gradient-to-br from-teal-700 to-blue-700 px-4 py-2.5 text-[0.92rem] font-bold text-slate-50 shadow-[0_10px_20px_rgba(29,78,216,0.2)] transition hover:-translate-y-px hover:shadow-[0_14px_24px_rgba(15,23,42,0.22)] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700"
        >
          Add Product
        </button>
      </div>
    </form>

    <div
      v-if="errorMessage"
      class="mb-4 rounded-xl border border-rose-300 bg-rose-100 px-4 py-3 text-[0.92rem] text-rose-700"
      role="alert"
    >
      <span>{{ errorMessage }}</span>
    </div>

    <div class="rounded-2xl border border-white/90 bg-white/80 p-5 shadow-[0_12px_28px_rgba(16,24,40,0.08)] backdrop-blur md:p-6">
      <div class="flex flex-wrap items-center justify-between gap-3">
        <h2 class="m-0 text-[1.08rem] font-bold tracking-[-0.01em]">Current Order</h2>
        <div class="rounded-full border border-blue-200 bg-gradient-to-br from-blue-50 to-blue-100 px-3.5 py-1.5 text-[0.84rem] font-bold text-blue-900">
          Total: ${{ orderTotal }}
        </div>
      </div>

      <!-- Completed: list products in the current order and update reactively. -->
      <ul v-if="order.products.length" class="mt-4 grid list-none gap-2.5 p-0">
        <li
          v-for="(product, index) in order.products"
          :key="`${product.name}-${index}`"
          class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-white/90 px-3.5 py-3"
        >
          <span class="font-bold text-slate-900">{{ product.name }}</span>
          <span class="tabular-nums text-slate-600">${{ Number(product.price).toFixed(2) }}</span>
        </li>
      </ul>
      <p v-else class="mt-4 text-slate-500">No products added yet.</p>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

import {
  Order,
  DigitalProduct,
  PhysicalProduct,
  SubscriptionProduct,
} from './orderClasses';

const order = ref(new Order());
const productType = ref('digital');
const productName = ref('');
const productPrice = ref('');
const productQuantity = ref('');
const downloadLink = ref('');
const weight = ref('');
const subscriptionDuration = ref('');
const errorMessage = ref('');

const resetForm = () => {
  productName.value = '';
  productPrice.value = '';
  productQuantity.value = '';
  downloadLink.value = '';
  weight.value = '';
  subscriptionDuration.value = '';
};

// Completed: addProduct creates the correct Product instance from form data,
// adds it to the order, and resets the form inputs.
const addProduct = () => {
  errorMessage.value = '';

  const name = productName.value.trim();
  const price = Number(productPrice.value);
  const quantity = Number(productQuantity.value);

  if (!name || Number.isNaN(price) || Number.isNaN(quantity)) {
    errorMessage.value = 'Please enter valid product details.';
    return;
  }

  let product;

  switch (productType.value) {
    case 'digital':
      product = new DigitalProduct(name, price, quantity, downloadLink.value);
      break;
    case 'physical':
      product = new PhysicalProduct(name, price, quantity, Number(weight.value));
      break;
    case 'subscription':
      product = new SubscriptionProduct(
        name,
        price,
        quantity,
        Number(subscriptionDuration.value)
      );
      break;
    default:
      errorMessage.value = 'Unsupported product type.';
      return;
  }

  order.value.addProduct(product);
  resetForm();
};

// Completed: calculate order total reactively from products in the order.
const orderTotal = computed(() => order.value.calculateTotal().toFixed(2));
  
</script>
