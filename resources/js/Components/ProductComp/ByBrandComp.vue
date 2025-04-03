<script setup>
import { ref, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import axios from "axios";

const page = usePage();
const brandId = page.props.brandId; // Get brand ID from Inertia props
const brandName = ref("");
const products = ref([]);
const isLoading = ref(true);
const errorMessage = ref("");

// Fetch products based on brand ID
const fetchProducts = async () => {
    try {
        isLoading.value = true;
        let res = await axios.get(`/product-by-brand/${brandId}`);
        products.value = res.data.data;

        // Set brand name if products are available
        if (products.value.length > 0) {
            brandName.value = products.value[0].brand.brandName;
        } else {
            brandName.value = "No Products Available";
        }
    } catch (error) {
        errorMessage.value = "Failed to load products. Please try again.";
    } finally {
        isLoading.value = false;
    }
};

onMounted(fetchProducts);

// Navigate back to the previous page
const back = () => {
    window.history.back();
};

// Format product price
const formatPrice = (price) => {
    return new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD",
    }).format(price);
};
</script>

<template>
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <!-- Display brand name, fallback to "No Products Available" -->
                        <h1>Brand: <span>{{ brandName }}</span></h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item">
                            <a @click="back" href="#">Back To Previous Page</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">This Page</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <!-- Show loading spinner while fetching data -->
            <div v-if="isLoading" class="text-center text-primary">
                <h4>Loading products...</h4>
            </div>

            <!-- Show error message if API call fails -->
            <div v-if="errorMessage" class="text-center text-danger">
                <h4>{{ errorMessage }}</h4>
            </div>

            <!-- Show message if no products are found -->
            <div v-if="!isLoading && products.length === 0 && !errorMessage" class="text-center text-danger">
                <h4>No Products Found</h4>
            </div>

            <div v-for="item in products" :key="item.id" class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="product-card shadow-lg rounded-lg overflow-hidden">
                    <a :href="`/ProductDetails?productId=${item.id}`" class="d-block position-relative">
                        <img :src="item.image" alt="Product Image" class="img-fluid w-100 img-thumbnail product-img" loading="lazy"/>
                    </a>
                    <div class="product-info text-center mt-2">
                        <h6 class="product-title">
                            <a :href="`/ProductDetails?productId=${item.id}`">{{ item.title }}</a>
                        </h6>
                        <div class="product-price">
                            <span class="price">{{ formatPrice(item.price) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Product card container */
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    background: white;
    padding: 20px;
}

/* Hover effect for product card */
.product-card:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

/* Product image styling */
.product-img {
    height: 150px;
    border-radius: 10px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

/* Scale image on hover */
.product-card:hover .product-img {
    transform: scale(1.1);
}

/* Overlay effect on hover */
.overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.4);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .overlay {
    opacity: 1;
}

/* Product title styling */
.product-title {
    color: #333;
    font-size: 1.25rem;
    font-weight: bold;
    text-align: center;
}

/* Product price styling */
.product-price {
    font-size: 1.1rem;
    color: #333;
    font-weight: bold;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .product-title {
        font-size: 1rem;
    }
}
</style>
