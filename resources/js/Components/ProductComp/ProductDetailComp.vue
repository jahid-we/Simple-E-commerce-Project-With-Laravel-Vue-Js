<script setup>
import { ref, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import axios from "axios";

const count = ref(1);
const selectedColor = ref("");
const selectedSize = ref("");
const isWishlisted = ref(false);
const page = usePage();
const productId = page.props.productId;
const productDetails = ref([]);
const props = defineProps({
    isCookie: Boolean,
});
const isCookie = page.props.isCookie;
const fullImage= ref("");

const setImage=(img)=>{
    fullImage.value=img;
}

const productDetail = async () => {
    try {
        let res = await axios.get(`/ProductDetailsById/${productId}`);
        productDetails.value = res.data.data;
        fullImage.value = productDetails.value[0]?.img1;
    } catch (error) {
        console.log("Error fetching product detail");
    }
};

const addToWishlist = async (productId) => {
    try {
        if (!isCookie) {
            alert("❌ Please login to add product to wishlist!");
            sessionStorage.setItem("last_location",window.location.href)
            window.location.href = "/login";
            return;
        }
        await axios.post(`/add-product-wish/${productId}`);
        alert("Product added to wishlist successfully!");
        isWishlisted.value = true;
    } catch (error) {
        console.log("Error adding product to wishlist");
    }
};

const addToCart = async () => {
    try {
        let postBody = {
            product_id: productId,
            color: selectedColor.value,
            size: selectedSize.value,
            qty: count.value,
        };

        if (!isCookie) {
            alert("❌ Please login to add product to cart!");
            sessionStorage.setItem("last_location",window.location.href)
            window.location.href = "/login";
            return;
        }
        await axios.post('/add-product-cart', postBody);
        alert("Product added to cart successfully!");
        setTimeout(() => {
            window.location.href = "/ProductCartPage";
        }, 1000);

    } catch (error) {
        console.log("Error adding product to cart");
    }
};

onMounted(productDetail);
</script>

<template>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                    <div class="product-image">
                        <div class="product_img_box">
                            <img :src="fullImage" class="w-100" />
                        </div>
                        <div class="row p-2">
                            <div class="row p-2">
                                <a
                                    v-for="(img, index) in [
                                        productDetails[0]?.img1,
                                        productDetails[0]?.img2,
                                        productDetails[0]?.img3,
                                        productDetails[0]?.img4,
                                    ]"
                                    :key="index"
                                    href="javascript:void(0)"
                                    @click.prevent="setImage(img)"
                                    class="col-3 product_img_box p-1"
                                >
                                    <img :src="img" class="w-100" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="pr_detail">
                        <div class="product_description">
                            <h4 id="p_title" class="product_title">
                                {{ productDetails[0]?.des }}
                            </h4>
                            <h1 id="p_price" class="price"></h1>
                        </div>
                        <div>
                            <p id="p_des"></p>
                        </div>
                    </div>

                    <label class="form-label">Size</label>
                    <select v-model="selectedSize" class="form-select">
                        <option
                            v-for="(
                                size, index
                            ) in productDetails[0]?.size?.split(',')"
                            :key="index"
                            :value="size"
                        >
                            {{ size }}
                        </option>
                    </select>

                    <label class="form-label">Color</label>
                    <select v-model="selectedColor" class="form-select">
                        <option
                            v-for="(
                                color, index
                            ) in productDetails[0]?.color?.split(',')"
                            :key="index"
                            :value="color"
                        >
                            {{ color }}
                        </option>
                    </select>

                    <hr />
                    <div class="cart_extra">
                        <div class="cart-product-quantity">
                            <div class="quantity">
                                <input
                                    v-show="count > 1"
                                    type="button"
                                    @click="count--"
                                    value="-"
                                    class="minus"
                                />
                                <input
                                    readonly
                                    v-model="count"
                                    id="p_qty"
                                    type="text"
                                    name="quantity"
                                    title="Qty"
                                    class="qty"
                                    size="4"
                                />
                                <input
                                    type="button"
                                    @click="count++"
                                    value="+"
                                    class="plus"
                                />
                            </div>
                        </div>
                        <div class="cart_btn">
                            <button
                                @click="addToCart"
                                class="btn btn-fill-out btn-addtocart"
                                type="button"
                            >
                                <i class="icon-basket-loaded"></i> Add to cart
                            </button>
                            <a
                                class="add_wishlist text-decoration-none text-black"
                                @click="addToWishlist(productId)"
                                href="#"
                                >{{ isWishlisted ? "❤️" :"🤍"  }}</a>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
