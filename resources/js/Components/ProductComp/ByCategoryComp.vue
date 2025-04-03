<script setup>
import { ref, onMounted } from "vue"; // Import Vue ref and lifecycle hooks
import { usePage } from "@inertiajs/vue3"; // Import Inertia.js usePage for page props
import axios from "axios"; // Import Axios for HTTP requests

const page = usePage(); // Get current page properties from Inertia
const categoryId = page.props.categoryId; // Extract category ID from page props
const categoryName = ref(""); // Reactive variable for storing category name
const products = ref([]); // Reactive array to store fetched products

// Function to fetch products based on category ID
const fetchProducts = async () => {
    try {
        let res = await axios.get(`/product-by-category/${categoryId}`); // Send GET request to fetch products
        products.value = res.data.data; // Store response data in products array

        // If products exist, set category name from the first product
        if (products.value.length > 0) {
            categoryName.value = products.value[0].category.categoryName;
        }
    } catch (error) {
        console.log("Error fetching products"); // Log error if request fails
    }
};

onMounted(fetchProducts); // Call fetchProducts when the component is mounted

// Function to navigate back to the previous page
const back = () => {
    window.history.back(); // Use browser history to go back
};
</script>

<template>
    <!-- Breadcrumb Section -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <!-- Display category name, show "No Data Found" if empty -->
                        <h1>Category: <span>{{ categoryName || "No Data Found" }}</span></h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <!-- Breadcrumb navigation -->
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item">
                            <a @click="back" href="#">Back To Previous Page</a> <!-- Go back to the previous page -->
                        </li>
                        <li class="breadcrumb-item"><a href="#">This Page</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Listing Section -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <!-- Show message when no products are found -->
            <div v-show="products.length === 0" class="text-center text-danger">
                <h4>No Data Found</h4>
            </div>

            <!-- Loop through products and display each one -->
            <div v-for="item in products" :key="item.id" class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="product-card shadow-lg rounded-lg overflow-hidden">
                    <!-- Product Image with clickable link to product details -->
                    <a :href="`/ProductDetails?productId=${item.id}`" class="d-block position-relative">
                        <img :src="item.image" alt="Product Image" class="img-fluid w-100 img-thumbnail product-img"/>
                    </a>
                    <div class="product-info text-center mt-2">
                        <!-- Product Title with clickable link -->
                        <h6 class="product-title">
                            <a :href="`/ProductDetails?productId=${item.id}`">{{ item.title }}</a>
                        </h6>
                        <!-- Product Price -->
                        <div class="product-price">
                            <span class="price">${{ item.price }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Product Card Styling */
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth animation on hover */
    position: relative;
    border-radius: 10px; /* Rounded corners */
    overflow: hidden;
    background: white;
    padding: 20px; /* Spacing inside the card */
}

/* Add shadow on hover */
.product-card:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

/* Product Image Styling */
.product-img {
    height: 150px; /* Fixed height */
    border-radius: 10px; /* Rounded corners */
    object-fit: cover; /* Maintain aspect ratio and cover the area */
    transition: transform 0.3s ease; /* Smooth transition effect */
}

/* Enlarge image slightly on hover */
.product-card:hover .product-img {
    transform: scale(1.1);
}

/* Overlay Effect on Hover */
.overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.4); /* Dark overlay */
    opacity: 0;
    transition: opacity 0.3s ease; /* Smooth fade-in effect */
}

/* Show overlay when hovering */
.product-card:hover .overlay {
    opacity: 1;
}

/* Product Title Styling */
.product-title {
    color: #fff; /* White text */
    font-size: 1.25rem; /* Medium font size */
    font-weight: bold; /* Bold text */
    text-transform: uppercase; /* Uppercase text */
    text-align: center; /* Center align */
}

/* Product Price Styling */
.product-price {
    font-size: 1.1rem; /* Slightly larger text */
    color: #333; /* Dark text */
    font-weight: bold; /* Bold text */
}

/* Responsive Styling for Small Screens */
@media (max-width: 768px) {
    .product-title {
        font-size: 1rem; /* Decrease font size for small screens */
    }
}
</style>
