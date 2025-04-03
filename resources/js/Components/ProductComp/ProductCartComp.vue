<script setup>
import PaymentMethodModalComp from "./PaymentMethodModalComp.vue"; // Import the PaymentMethodModalComp component
import { ref, onMounted, computed, watch } from "vue"; // Import Vue.js composition API functions
import { toWords } from "number-to-words"; // Import a utility to convert numbers to words
import { usePage } from "@inertiajs/vue3"; // Import Inertia.js's page hook for accessing shared data
import axios from "axios"; // Import axios for making HTTP requests

// Setup reactive references
const page = usePage(); // Get the current page from Inertia
const products = ref([]); // Reactive reference to store the list of products in the cart
const total = ref(0); // Reactive reference for the total price
const paymentMethod = ref([]); // Reactive reference to store payment methods
const showModal = ref(false); // Reactive reference to control the visibility of the payment method modal
const loading = ref(false); // Reactive reference to track the loading state during API calls

// Computed property to convert total price to words
const totalInWords = computed(() => {
    if (total.value === 0) return "Zero"; // Return "Zero" if total is 0
    let words = toWords(total.value); // Convert the total number to words
    return words.replace(/\b\w/g, (char) => char.toUpperCase()); // Capitalize the first letter of each word
});

// Function to fetch the cart list from the server
const getCartList = async () => {
    try {
        const res = await axios.get("/product-cart"); // Make a GET request to fetch cart items
        products.value = res.data.data; // Store the fetched products in the products reference
        totalPrice(); // Calculate the total price after fetching the cart
    } catch (error) {
        console.log("Error fetching cart list"); // Log error if the request fails
    }
};

// Function to calculate the total price of the products in the cart
const totalPrice = async () => {
    let sum = 0; // Initialize sum variable
    products.value.forEach((item) => {
        sum += parseFloat(item.price); // Add the price of each product to the sum
    });
    total.value = sum; // Update the total reactive reference
};

// Function to remove a product from the cart
const remove = async (ProductId) => {
    try {
        loading.value = true; // Set loading state to true while the request is in progress
        await axios.post(`/delete-product-cart/${ProductId}`); // Make a POST request to remove the product by its ID
        successToast("Product removed from cart successfully!"); // Display success toast on successful removal
        getCartList(); // Refresh the cart list
    } catch (error) {
        errorToast("Error removing product from cart"); // Display error toast if the request fails
    } finally {
        loading.value = false; // Set loading state to false once the operation is complete
    }
};

// Function to initiate the checkout process
const checkOut = async () => {
    try {
        loading.value = true; // Set loading state to true
        let res = await axios.get("/create-invoice"); // Make a GET request to create an invoice
        paymentMethod.value = res.data.data[0].paymentMethod; // Set the available payment methods from the response
        showModal.value = true; // Show the payment method modal
    } catch (error) {
        errorToast(error.response?.data?.data || "An error occurred. Please try again."); // Display error toast on failure
    } finally {
        loading.value = false; // Set loading state to false after completing the operation
    }
};

// Watch the showModal value to enable/disable body scroll when the modal is open/closed
watch(showModal, (newValue) => {
    if (newValue) {
        document.body.style.overflow = "hidden"; // Disable scrolling when the modal is visible
    } else {
        document.body.style.overflow = ""; // Re-enable scrolling when the modal is hidden
    }
});

// Fetch the cart list when the component is mounted
onMounted(getCartList);
</script>

<template>
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Cart List 🛒</h1> <!-- Title of the page -->
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li> <!-- Home breadcrumb -->
                        <li class="breadcrumb-item">
                            <a href="#">This Page</a> <!-- Current page breadcrumb -->
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END CONTAINER-->
    </div>

    <!-- Display a message when the cart is empty -->
    <div
        v-show="products.length === 0"
        class="text-center text-danger m-5 h-100"
    >
        <h1>🚫</h1>
        <h4>Cart List is Empty</h4>
    </div>

    <!-- Display cart items if available -->
    <div v-show="products.length !== 0" class="mt-5">
        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive shop_cart_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Product Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody id="byList">
                                <tr
                                    v-for="(item, index) in products"
                                    :key="index"
                                >
                                    <td class="product-thumbnail">
                                        <img
                                            :src="item.product.image"
                                            alt="product"
                                        />
                                    </td>
                                    <td class="product-name">
                                        {{ item.product.title }}
                                    </td>
                                    <td class="product-quantity">
                                        {{ item.qty }}
                                    </td>
                                    <td class="product-subtotal">
                                        {{ item.price }}
                                    </td>
                                    <td class="product-remove">
                                        <a
                                            href="javascript:void(0)"
                                            class="remove"
                                            @click.prevent="remove(item.product.id)"
                                            :disabled="loading"
                                        >
                                            <span
                                                v-if="loading"
                                                class="spinner-border spinner-border-sm"
                                            ></span>
                                            <i v-else class="ti-close"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="px-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                                                <span class="fw-bold" id="total">
                                                    Total: {{ total }} TK (Only)<br />
                                                </span>
                                                <span class="fw-bold">In Words: </span><span class="text-danger">{{ totalInWords }} Taka</span>
                                            </div>
                                            <div class="col-lg-8 col-md-6 text-start text-md-end">
                                                <button
                                                    @click.prevent="checkOut()"
                                                    class="btn btn-danger btn-sm"
                                                    type="submit"
                                                    :disabled="loading"
                                                >
                                                    <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                                                    <span v-else>Checkout</span>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Method Modal -->
    <PaymentMethodModalComp
        v-model:showModal="showModal"
        v-model:paymentMethod="paymentMethod"
    />
    <!-- End Payment Method Modal -->
</template>

<style scoped></style>
