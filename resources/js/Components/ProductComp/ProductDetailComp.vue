<script setup>
import { ref, onMounted } from "vue"; // Importing Vue Composition API functions
import { usePage } from "@inertiajs/vue3"; // Importing Inertia.js for page properties
import axios from "axios"; // Importing Axios for making HTTP requests

// Reactive state variables
const loading = ref(false); // To manage the loading state during API calls
const count = ref(1); // To track the quantity of the product
const selectedColor = ref(""); // To store the selected color
const selectedSize = ref(""); // To store the selected size
const isWishlisted = ref(false); // To track if the product is added to wishlist
const page = usePage(); // Using Inertia.js to access page props
const productId = page.props.productId; // Extracting the product ID from page props
const productDetails = ref([]); // To store the details of the product fetched from the server
const props = defineProps({
    isCookie: Boolean, // Defining a prop to check if the user is logged in through cookies
});
const isCookie = page.props.isCookie; // Extracting the user's login status from page props
const fullImage = ref(""); // To store the image that will be displayed

// Function to change the full product image when a thumbnail is clicked
const setImage = (img) => {
    fullImage.value = img; // Updating the full image to the clicked thumbnail
};

// Function to fetch product details from the server
const productDetail = async () => {
    try {
        // Fetching the product details using the product ID
        let res = await axios.get(`/ProductDetailsById/${productId}`);
        productDetails.value = res.data.data; // Storing the fetched product details
        fullImage.value = productDetails.value[0]?.img1; // Setting the first image as the default full image
    } catch (error) {
        console.log("Error fetching product detail"); // Logging error if fetching fails
    }
};

// Function to add the product to the wishlist
const addToWishlist = async (productId) => {
    try {
        // If the user is not logged in, redirect them to the login page
        if (!isCookie) {
            errorToast("Please login to add product to wishlist!"); // Show an error message
            sessionStorage.setItem("last_location", window.location.href); // Store the current page URL for later redirection
            window.location.href = "/login"; // Redirect the user to the login page
            return;
        }
        // Sending request to add the product to the wishlist
        await axios.post(`/add-product-wish/${productId}`);
        successToast("Product added to wishlist successfully!"); // Show success message
        isWishlisted.value = true; // Mark the product as wishlisted
    } catch (error) {
        errorToast("Error adding product to wishlist"); // Show error message if request fails
    }
};

// Function to add the product to the cart
const addToCart = async () => {
    try {
        // Preparing the data to send to the server
        let postBody = {
            product_id: productId,
            color: selectedColor.value,
            size: selectedSize.value,
            qty: count.value,
        };

        // If the user is not logged in, prompt them to login
        if (!isCookie) {
            errorToast("Please login to add product to cart!"); // Show error message
            sessionStorage.setItem("last_location", window.location.href); // Store the current page URL for later redirection
            loading.value = true; // Set the loading state to true
            window.location.href = "/login"; // Redirect the user to the login page
            return;
        } else {
            loading.value = false; // Reset loading state if user is logged in
        }
        loading.value = true; // Set loading state to true while making the request
        // Sending request to add the product to the cart
        await axios.post('/add-product-cart', postBody);
        successToast("Product added to cart successfully!"); // Show success message
        setTimeout(() => {
            window.location.href = "/ProductCartPage"; // Redirect the user to the cart page after 1 second
        }, 1000);

    } catch (error) {
        errorToast("Error adding product to cart"); // Show error message if request fails
    } finally {
        loading.value = false; // Reset loading state after the operation completes
    }
};

// Fetching product details when the component is mounted
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
                                :disabled="loading"
                            >
                                <i class="icon-basket-loaded">
                                </i>
                                <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                                <span v-else>Add to cart</span>
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
