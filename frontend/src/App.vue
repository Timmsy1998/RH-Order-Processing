<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Order Manager</h1>

    <form
      @submit.prevent="addProduct"
      class="mb-8 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
    >
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="productType"
        >
          Product Type
        </label>
        <select
          v-model="productType"
          id="productType"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        >
          <option value="digital">Digital</option>
          <option value="physical">Physical</option>
          <option value="subscription">Subscription</option>
        </select>
      </div>

      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="productName"
        >
          Product Name
        </label>
        <input
          v-model="productName"
          id="productName"
          type="text"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required
        />
      </div>

      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="productPrice"
        >
          Price
        </label>
        <input
          v-model="productPrice"
          id="productPrice"
          type="number"
          step="0.01"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required
        />
      </div>

      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="productQuantity"
        >
          Quantity
        </label>
        <input
          v-model="productQuantity"
          id="productQuantity"
          type="number"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required
        />
      </div>

      <div v-if="productType === 'digital'" class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="downloadLink"
        >
          Download Link
        </label>
        <input
          v-model="downloadLink"
          id="downloadLink"
          type="url"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        />
      </div>

      <div v-if="productType === 'physical'" class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="weight">
          Weight
        </label>
        <input
          v-model="weight"
          id="weight"
          type="number"
          step="0.01"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        />
      </div>

      <div v-if="productType === 'subscription'" class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="subscriptionDuration"
        >
          Subscription Duration (months)
        </label>
        <input
          v-model="subscriptionDuration"
          id="subscriptionDuration"
          type="number"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        />
      </div>

      <div class="flex items-center justify-between">
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >
          Add Product
        </button>
      </div>
    </form>

    <div
      v-if="errorMessage"
      class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
      role="alert"
    >
      <span class="block sm:inline">{{ errorMessage }}</span>
    </div>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <h2 class="text-xl font-bold mb-4">Current Order</h2>
      <div class="text-xl font-bold">Total: ${{ orderTotal }}</div>

      <!-- Completed: list products in the current order and update reactively. -->
      <ul v-if="order.products.length" class="mt-4 space-y-2">
        <li
          v-for="(product, index) in order.products"
          :key="`${product.name}-${index}`"
          class="border rounded px-3 py-2"
        >
          <span class="font-medium">{{ product.name }}</span>
          <span class="ml-2 text-gray-600">${{ Number(product.price).toFixed(2) }}</span>
        </li>
      </ul>
      <p v-else class="mt-4 text-gray-500">No products added yet.</p>
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

// TODO: Implement the calculation of the order total
// const orderTotal = ?;
  
</script>
