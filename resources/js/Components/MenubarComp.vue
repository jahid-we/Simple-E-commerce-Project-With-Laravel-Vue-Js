<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import axios from "axios";

const categories = ref([]);

const fetchCategories = async () => {
    try {
        let res = await axios.get("/category-list");
        categories.value = res.data.data; // Assuming the response contains an array of categories
    } catch (error) {
        console.error("Error fetching categories", error);
    }
};

onMounted(() => {
    fetchCategories();
});


const page = usePage();
// Check if the user is logged in
const props = defineProps({
  isCookie: Boolean,
});
const isCookie = page.props.isCookie;


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
                                <a href="javascript:void(0);" class="nav-link search_trigger">
                                    <i class="linearicons-magnifier"></i> Search
                                </a>
                                <div class="search_wrap">
                                    <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                                    <form>
                                        <input type="text" placeholder="Search" class="form-control" id="search_input">
                                        <button type="submit" class="search_icon">
                                            <i class="ion-ios-search-strong"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="search_overlay"></div>
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
