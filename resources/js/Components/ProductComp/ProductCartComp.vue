<script setup>
import PaymentMethodModalComp from "./PaymentMethodModalComp.vue";
import { ref, onMounted, computed, watch } from "vue";
import { toWords } from "number-to-words";
import { usePage } from "@inertiajs/vue3";
import axios from "axios";

const page = usePage();
const products = ref([]);
const total = ref(0);
const paymentMethod = ref([]);
const showModal = ref(false);

const totalInWords = computed(() => {
    if (total.value === 0) return "Zero";

    let words = toWords(total.value);
    return words.replace(/\b\w/g, (char) => char.toUpperCase());
});

const getCartList = async () => {
    try {
        const res = await axios.get("/product-cart");
        products.value = res.data.data;
        totalPrice();
    } catch (error) {
        console.log("Error fetching cart list");
    }
};

const totalPrice = async () => {
    let sum = 0;
    products.value.forEach((item) => {
        sum += parseFloat(item.price);
    });
    total.value = sum;
};

const remove = async (ProductId) => {
    try {
        await axios.post(`/delete-product-cart/${ProductId}`);
        alert("✅ Product removed from cart successfully!");
        getCartList();
    } catch (error) {
        console.log("❌ Error removing product from cart");
    }
};

const checkOut = async () => {
  try {
    let res = await axios.get("/create-invoice");
    paymentMethod.value = res.data.data[0].paymentMethod;
    showModal.value = true;
  } catch (error) {
    console.log("❌ Error creating invoice");
  }
};

// Watch the showModal value and add/remove the "no-scroll" class to the body
watch(showModal, (newValue) => {
  if (newValue) {
    document.body.style.overflow = 'hidden'; // Disable scrolling
  } else {
    document.body.style.overflow = ''; // Re-enable scrolling
  }
});

onMounted(getCartList);
</script>

<template>
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Cart List 🛒</h1>
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
        <!-- END CONTAINER-->
    </div>
        <div v-show="products.length === 0" class="text-center text-danger m-5 h-100">
                <h1>🚫</h1>
                <h4>Cart List is Empty</h4>
            </div>
    <div v-show="products.length !== 0" class="mt-5">
        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive shop_cart_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">
                                        Product Image
                                    </th>
                                    <th class="product-name">Product</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody id="byList">
                                <tr
                                    v-for="(item, index) in products"
                                    :key="index"
                                >
                                    <td class="product-thumbnail">
                                        <img
                                            :src="item.product.image"
                                            alt="product"
                                        />
                                    </td>
                                    <td class="product-name">
                                        {{ item.product.title }}
                                    </td>
                                    <td class="product-quantity">
                                        {{ item.qty }}
                                    </td>
                                    <td class="product-subtotal">
                                        {{ item.price }}
                                    </td>
                                    <td class="product-remove">
                                        <a
                                            class="remove"
                                            @click.prevent="
                                                remove(item.product.id)
                                            "
                                            ><i class="ti-close"></i
                                        ></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="px-0">
                                        <div class="row g-0 align-items-center">
                                            <div
                                                class="col-lg-4 col-md-6 mb-3 mb-md-0"
                                            >
                                               <span class="fw-bold" id="total">
                                                   Total: {{ total }} TK (Only)<br>
                                                </span>
                                               <span class="fw-bold">In Words:  </span><span class="text-danger" >{{ totalInWords }} Taka</span>
                                            </div>
                                            <div
                                                class="col-lg-8 col-md-6 text-start text-md-end"
                                            >
                                                <button
                                                    @click.prevent="checkOut()"
                                                    class="btn btn-line-fill btn-sm"
                                                    type="submit"
                                                >
                                                    Check Out
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- Payment Method Modal -->
        <PaymentMethodModalComp
            v-model:showModal="showModal"
            v-model:paymentMethod="paymentMethod"
        />
    <!-- End Payment Method Modal -->
</template>

<style scoped>

</style>
