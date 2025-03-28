<script setup>
import { ref, onMounted, watch } from "vue";
import { usePage} from "@inertiajs/vue3";
import axios from "axios";

const categories = ["new", "popular", "top", "special", "trending", "regular"];
const activeCategory = ref("new");
const products = ref([]);
const page = usePage();
const props = defineProps({
  isCookie: Boolean,
});
const isCookie = page.props.isCookie;

const fetchProducts = async () => {
    try {
        let res = await axios.get(`/product-by-remark/${activeCategory.value}`);
        products.value = res.data.data;
    } catch (error) {
        console.error("Error fetching products:", error);
    }
};

// Add Wishlist  Function  Start ********************************

const addToWishlist = async (productId) => {
    try {
        if(!isCookie){
            // alert("❌ Please login to add product to wishlist!");
            errorToast("Please login to add product to wishlist!");
            window.location.href = "/login";
            return;
        }
        await axios.post(`/add-product-wish/${productId}`);
        // alert("Product added to wishlist successfully!");
        successToast("Product added to wishlist successfully!");
    } catch (error) {
        // console.log("Error adding product to wishlist");
        errorToast("Error adding product to wishlist");
    }
};

// Fetch products on component mount and when the category changes
onMounted(fetchProducts);
watch(activeCategory, fetchProducts);
</script>

<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="heading_s1 text-center mb-4">
                    <h2 class="font-weight-bold">Exclusive Products</h2>
                    <p class="text-muted">
                        Browse through a curated selection of exclusive
                        products.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="tab-style1">
                    <ul class="nav nav-tabs justify-content-center">
                        <li
                            v-for="(category, index) in categories"
                            :key="index"
                            class="nav-item"
                        >
                            <button
                                class="nav-link"
                                :class="{ active: activeCategory === category }"
                                @click="activeCategory = category"
                            >
                                {{
                                    category.charAt(0).toUpperCase() +
                                    category.slice(1)
                                }}
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content mt-4">
                    <div class="tab-pane fade show active">
                        <div class="row shop_container">
                            <div
                                v-for="item in products"
                                :key="item.id"
                                class="col-lg-3 col-md-4 col-6 mb-4"
                            >
                                <div class="product-card">
                                    <div class="product-img-wrapper">
                                        <a href="#">
                                            <img
                                                :src="item.image"
                                                alt="product_img"
                                                class="img-fluid rounded"
                                            />
                                        </a>
                                        <div class="product-overlay">
                                            <ul class="action-buttons">
                                                <li>
                                                    <!-- <a
                                                        title="Add to Cart"
                                                        :href="`/details?id=${item.id}`"
                                                        class="zoom-btn"
                                                    >
                                                        <i
                                                            class="icon-basket"
                                                        ></i>
                                                    </a> -->
                                                    <a
                                                        title="Add to Wishlist"
                                                        href="javascript:void(0);"
                                                        class="zoom-btn px-1"
                                                        @click="
                                                            addToWishlist(
                                                                item.id
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="icon-heart"
                                                        ></i>
                                                    </a>
                                                    <a
                                                        title="Ouick View"
                                                        :href="`/ProductDetails?productId=${item.id}`"
                                                        class="zoom-btn px-1"
                                                    >
                                                        <i
                                                            class="icon-magnifier-add"
                                                        ></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div
                                        class="product-details text-center mt-3"
                                    >
                                        <h6 class="product-title mb-2">
                                            <a
                                                :href="`/details?id=${item.id}`"
                                                class="text-dark"
                                                >{{ item.title }}</a
                                            >
                                        </h6>
                                        <div class="product-price mb-2">
                                            <span class="price"
                                                >${{ item.price }}</span
                                            >
                                        </div>
                                        <div class="rating-wrap">
                                            <div class="rating">
                                                <div
                                                    class="rating-bar"
                                                    :style="{
                                                        width:
                                                            (item.star / 5) *
                                                                100 +
                                                            '%',
                                                    }"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p
                                v-if="products.length === 0"
                                class="text-center w-100"
                            >
                                No products available.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* General Styles */
p {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 25px;
}

a {
    color: #292b2c;
    text-decoration: none;
    transition: all 0.3s ease;
}

a:hover {
    color: #ff324d;
}

a:focus {
    outline: none;
}

/* Tab styles */
.nav-tabs {
    border-bottom: 2px solid #e1e1e1;
}

.nav-link {
    border: none;
    color: #495057;
    font-size: 1rem;
    padding: 12px 20px;
    text-transform: capitalize;
    border-radius: 5px;
    background-color: transparent;
    transition: background-color 0.3s ease;
}

.nav-link.active {
    color: #ff324d;
    font-weight: bold;
    background-color: rgba(255, 50, 77, 0.1);
}

.nav-item {
    margin: 0 10px;
}

/* Product Card */
.product-card {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

.product-img-wrapper img {
    border-bottom: 2px solid #f1f1f1;
    transition: transform 0.3s ease;
}

.product-card:hover .product-img-wrapper img {
    transform: scale(1.05);
}

.product-overlay {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(0, 0, 0, 0.4);
    padding: 8px;
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.action-buttons {
    list-style: none;
    margin: 0;
    padding: 0;
}

.action-buttons li {
    display: inline-block;
}

.zoom-btn {
    color: white;
    font-size: 1.4rem;
}

.product-details h6 {
    font-size: 1.1rem;
    font-weight: 600;
}

.product-price {
    font-size: 1.2rem;
    color: #ff324d;
    font-weight: 700;
}

.rating-wrap {
    margin-top: 10px;
}

.rating {
    position: relative;
    height: 6px;
    background: #ddd;
    border-radius: 3px;
}

.rating-bar {
    height: 100%;
    background: #ffd700;
    border-radius: 3px;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .product-card {
        margin-bottom: 20px;
    }

    .nav-link {
        font-size: 0.9rem;
        padding: 8px 15px;
    }
}
</style>
