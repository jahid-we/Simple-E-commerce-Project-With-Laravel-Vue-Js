<script setup>
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

</script>

<template>
  <div class="section ">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="heading_s4 text-center mb-4">
            <h2 class="font-weight-bold mb-2">Top Categories</h2>
            <p class="text-muted">
              Explore a variety of categories that suit your needs. Discover more with just a click.
            </p>
          </div>
        </div>
      </div>

      <div id="TopCategoryItem" class="row justify-content-center mt-5">
        <div v-for="item in categories" :key="item.id" class="col-sm-6 col-md-4 col-lg-3 mb-4">
          <div class="category-card shadow-lg rounded-lg overflow-hidden">
            <a :href="`/ByCategory?CategoryId=${item.id}`" class="d-block position-relative">
              <img :src="item.categoryImg" alt="Category Image" class="img-fluid w-100 img-thumbnail category-img"/>
              <div class="overlay d-flex justify-content-center align-items-center">
                <span class="category-name">{{ item.categoryName }}</span>
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

.category-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  position: relative;
  border-radius: 10px;
}

.category-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.category-img {
  height: 150px;
  border-radius: 10px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.category-card:hover .category-img {
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

.category-card:hover .overlay {
  opacity: 1;
}

.category-name {
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
  .category-name {
    font-size: 1rem;
  }
}
</style>
