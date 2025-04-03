<script setup>
import { ref, onMounted } from "vue"; // Import necessary Vue composition API hooks
import axios from "axios"; // Import Axios for making HTTP requests

// Reactive reference to store the list of brands fetched from the API
const brands = ref([]);

// Function to fetch the list of brands from the server
const getBrands = async () => {
    try {
        // Send GET request to fetch brand list
        let res = await axios.get("/brand-list");

        // Store the fetched data in the 'brands' reactive reference
        brands.value = res.data.data; // Assuming the response contains an array of brands
    } catch (error) {
        // Handle any errors that occur during the request
        console.error("Error fetching brands", error);
    }
};

// Fetch the brand list when the component is mounted
onMounted(() => {
    getBrands(); // Trigger the API call when the component is mounted
});

</script>


<template>
  <div class="section py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="heading_s4 text-center mb-4">
            <h2 class="font-weight-bold mb-2">Top Brands</h2>
            <p class="text-muted">
              Explore our premium brands and shop from the most trusted names.
            </p>
          </div>
        </div>
      </div>

      <div id="TopBrandItem" class="row justify-content-center mt-5">
        <div v-for="item in brands" :key="item.id" class="col-sm-6 col-md-4 col-lg-3 mb-4">
          <div class="brand-card shadow-lg rounded-lg overflow-hidden">
            <a :href="`/ByBrand?BrandId=${item.id}`" class="d-block position-relative">
              <img :src="item.brandImg" alt="Brand Logo" class="img-fluid w-100 img-thumbnail brand-img"/>
              <div class="overlay d-flex justify-content-center align-items-center">
                <span class="brand-name">{{ item.brandName }}</span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.section {
  background-color: #f8f9fa;
}

.heading_s4 h2 {
  font-size: 2.5rem;
  color: #333;
}

p {
  color: #6c757d;
  line-height: 1.6;
}

.brand-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  position: relative;
  border-radius: 10px;
}

.brand-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.brand-img {
  height: 150px;
  border-radius: 10px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.brand-card:hover .brand-img {
  transform: scale(1.1);
}

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

.brand-card:hover .overlay {
  opacity: 1;
}

.brand-name {
  color: #fff;
  font-size: 1.25rem;
  font-weight: bold;
  text-transform: uppercase;
  text-align: center;
}

a {
  text-decoration: none;
}

@media (max-width: 768px) {
  .heading_s4 h2 {
    font-size: 2rem;
  }
  .brand-name {
    font-size: 1rem;
  }
}
</style>
