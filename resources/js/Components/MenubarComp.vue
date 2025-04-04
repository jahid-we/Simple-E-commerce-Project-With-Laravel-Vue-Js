<script setup>
import { usePage, Link } from "@inertiajs/vue3"; // Import Inertia.js hooks for routing and page props
import { ref, onMounted } from "vue"; // Import Vue Composition API for reactivity and lifecycle hooks
import axios from "axios"; // Import Axios for making HTTP requests

// Reactive reference to store categories fetched from the server
const categories = ref([]);

// Function to fetch categories from the server
const fetchCategories = async () => {
    try {
        let res = await axios.get("/category-list"); // API request to fetch categories
        categories.value = res.data.data; // Assuming the response contains an array of categories
    } catch (error) {
        console.error("Error fetching categories", error); // Log error if fetching fails
    }
};

// Fetch categories when the component is mounted
onMounted(() => {
    fetchCategories();
});

// Inertia.js page props for checking login status
const page = usePage();
// Define a prop for isCookie to check login status using cookies
const props = defineProps({
  isCookie: Boolean,
});
const isCookie = page.props.isCookie; // Check if user is logged in based on cookies
</script>


<template>
    <header  class="header_wrap fixed-top header_with_topbar">
        <!-- Top Header -->
        <div class="top-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <ul class="contact_detail text-center text-lg-start">
                                <li><i class="ti-mobile"></i><span>123-456-7890</span></li>
                                <li><i class="ti-email"></i><span>info@apple.com</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center text-md-end">
                            <ul class="header_list">
                                <li><a href="/policy?type=about">About</a></li>
                                <template v-if="isCookie">
                                    <li>
                                        <a href="/profile"><i class="linearicons-user"></i> Account</a>
                                    </li>
                                    <li>
                                        <a class="btn btn-danger btn-sm" href="/logout"> Logout</a>
                                    </li>
                                </template>
                                <template v-else>
                                    <li>
                                        <a class="btn btn-danger btn-sm" href="/login">Login</a>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Header -->
        <div class="bottom_header dark_skin main_menu_uppercase">
            <div class="container">
                <nav class="navbar navbar-expand-lg ">
                    <a class="navbar-brand" href="/">
                        <img class="logo_dark" src="/public/assets/images/logo_dark.png" alt="logo" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-expanded="false">
                        <span class="ion-android-menu"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li><a class="nav-link nav_item" href="/">Home</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">Products</a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li v-for="category in categories" :key="category.id">
                                            <a class="dropdown-item nav-link nav_item" :href="`/ByCategory?CategoryId=${category.id}`">
                                                {{ category.categoryName }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li v-show="isCookie" ><a class="nav-link nav_item" href="/ProductWishPage"><i class="ti-heart"></i> Wish</a></li>
                            <li v-show="isCookie"><a class="nav-link nav_item" href="/ProductCartPage"><i class="linearicons-cart"></i> Cart</a></li>
                            <li>
                                <form class="d-flex mt-3">
                                    <input class="form-control w-50 h-50 me-2" type="text" placeholder="Search">
                                    <button class="btn btn-sm btn-outline-danger" type="button">Search</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>
<style scoped>
p {
	color:#687188;
	line-height: 28px;
	margin-bottom: 25px;
}
a {
	color: #292b2c;
	text-decoration: none;
	-webkit-transition: all 0.3s ease-in-out;
	transition: all .3s ease-in-out;
}
a:hover {
	color: #FF324D;
	text-decoration: none;
}
a:focus {
	outline: none;
}
</style>
