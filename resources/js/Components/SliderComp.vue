<script setup>
import { ref, onMounted, onUnmounted, nextTick } from "vue";
import { usePage, Link } from "@inertiajs/vue3";
const page = usePage();
const productSliders = ref([]);
const carousel = ref(null);
let flickityInstance = null;

onMounted(async () => {
    productSliders.value = page.props.productSlider || [];

    // Ensure DOM updates before initializing Flickity
    await nextTick();

    if (carousel.value) {
        flickityInstance = new Flickity(carousel.value, {
            cellAlign: "center",
            contain: true,
            wrapAround: true,
            autoPlay: 3000,
            prevNextButtons: false,
            pageDots: true,
        });
    }
});

// Clean up Flickity instance on unmount
onUnmounted(() => {
    if (flickityInstance) {
        flickityInstance.destroy();
    }
});
</script>

<template>
    <div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap mb-5 ">
        <div ref="carousel" class="carousel mb-5">
            <div
                v-for="(item, index) in productSliders"
                :key="index"
                class="carousel-cell"
                :style="{
                    backgroundImage: 'url(' + item.image + ')',
                    backgroundSize: 'cover',
                    backgroundPosition: 'center',
                    backgroundRepeat: 'no-repeat',
                }"
            >
                <div class="banner_slide_content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 col-9">
                                <div class="banner_content overflow-hidden">
                                    <h5
                                        class="mb-3 staggered-animation font-weight-light"
                                        data-animation="slideInLeft"
                                        data-animation-delay="0.5s"
                                    >
                                        Price - ${{ item.price }}
                                    </h5>
                                    <h2
                                        class="staggered-animation"
                                        data-animation="slideInLeft"
                                        data-animation-delay="1s"
                                    >
                                        {{ item.title }}
                                    </h2>
                                    <Link
                                        class="btn btn-fill-out rounded-0 staggered-animation text-uppercase"
                                        :href="
                                            '/ProductDetailsById/' +
                                            item.product_id
                                        "
                                        data-animation="slideInLeft"
                                        data-animation-delay="1.5s"
                                    >
                                        Shop Now
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.carousel {
    width: 100%;
    max-width: 1250px;
    margin: 0 auto;
}

.carousel-cell {
    width: 100%;
    height: 500px; /* Adjust as needed */
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f5f5f5;
    border-radius: 10px;
}
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
