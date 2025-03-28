<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const wishlists = ref([]);

const getWishList = async () => {
    try {
        const res = await axios.get("/product-wish");
        wishlists.value = res.data.data;
    } catch (error) {
        console.log(res.data.data);
    }
};

// Back Function to go previous page
const back = () => {
    window.history.back();
};

// Remove product from wishlist
const removeWish = async (id) => {
    try {
        await axios.post(`/delete-product-wish/${id}`);
        // alert("✅ Product removed from wishlist successfully!");
        successToast("Product removed from wishlist successfully!");
        getWishList();
    } catch (error) {
        // console.log("❌ Error removing product from wishlist");
        errorToast("Error removing product from wishlist");
    }
};

onMounted(getWishList);
</script>

<template>
    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Wish List</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item">
                            <a href="#">This Page</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION BREADCRUMB -->
    <div class="mt-5">
        <div class="container my-5">
            <div id="byList" class="row">
                <div
                    v-show="wishlists.length === 0"
                    class="text-center text-danger"
                >
                    <h4>No Data Found</h4>
                </div>
                <div class="col-md-12">
                    <button title="Back TO Previous Page " @click="back" class="btn btn-lg btn-black mb-5">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </div>

                <div
                    v-for="item in wishlists"
                    :key="item.id"
                    class="col-lg-3 col-md-4 col-6"
                >
                    <div class="product">
                        <div class="product_img">
                            <a
                                :href="`/ProductDetails?productId=${item.product.id}`"
                            >
                                <img
                                    :src="item.product.image"
                                    alt="product_img9"
                                />
                            </a>
                            <div class="product_action_box">
                                <ul class="list_none pr_action_btn">
                                    <li>
                                        <a
                                            :href="`/ProductDetails?productId=${item.product.id}`"
                                            class="popup-ajax"
                                            ><i class="icon-magnifier-add"></i
                                        ></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product_info">
                            <h5 class="product_title">
                                <a class="text-decoration-none"
                                    :href="`/ProductDetails?productId=${item.product.id}`"
                                >{{ item.product.title }}</a>
                            </h5>
                            <div class="product_price">
                                <span class="price">{{
                                    item.product.price
                                }}</span>
                            </div>
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="">
                                        {{ item.product.rating }}
                                    </div>
                                </div>
                            </div>
                            <button
                                class="btn remove btn-sm my-2 btn-danger"
                                @click="removeWish(item.id)"
                            >
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
