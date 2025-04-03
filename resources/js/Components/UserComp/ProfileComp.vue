<script setup>
import { ref , onMounted } from 'vue'; // Importing Vue Composition API
import axios from 'axios'; // Importing Axios for HTTP requests

// Reactive variables to hold customer and shipping information
const loading = ref(false);

// Customer information
const customer = ref({
    name: '',
    address: '',
    city: '',
    state: '',
    postcode: '',
    country: '',
    phone: '',
    fax: ''
});

// Shipping information
const shipping = ref({
    name: '',
    address: '',
    city: '',
    state: '',
    postcode: '',
    country: '',
    phone: ''
});

// Fetch customer profile data from API
const getProfile = async () => {
    try {
        let res = await axios.get('/customer-profile-by-id');
        if(res.data.msg == true) {
            // Mapping the API response to customer and shipping data
            customer.value = {
                name: res.data.data.cus_name,
                address: res.data.data.cus_add,
                city: res.data.data.cus_city,
                state: res.data.data.cus_state,
                postcode: res.data.data.cus_postcode,
                country: res.data.data.cus_country,
                phone: res.data.data.cus_phone,
                fax: res.data.data.cus_fax
            };

            shipping.value = {
                name: res.data.data.ship_name,
                address: res.data.data.ship_add,
                city: res.data.data.ship_city,
                state: res.data.data.ship_state,
                postcode: res.data.data.ship_postcode,
                country: res.data.data.ship_country,
                phone: res.data.data.ship_phone
            };
        } else {
            console.log(res.data.data); // Handle case where profile data is not returned
        }
    } catch (error) {
        console.log(error); // Log any error during the API call
    }
}

// Fetch profile data when the component is mounted
onMounted(() => {
    getProfile();
});

// ************************************************

// Function to create or update the profile
const ProfileCreateOrUpdate = async () => {
    let postBody = {
        // Prepare the data to be sent in the API request
        "cus_name": customer.value.name ,
        "cus_add": customer.value.address,
        "cus_city": customer.value.city,
        "cus_state": customer.value.state,
        "cus_postcode": customer.value.postcode,
        "cus_country": customer.value.country,
        "cus_phone": customer.value.phone,
        "cus_fax": customer.value.fax,
        "ship_name": shipping.value.name,
        "ship_add": shipping.value.address,
        "ship_city": shipping.value.city,
        "ship_state": shipping.value.state,
        "ship_postcode": shipping.value.postcode,
        "ship_country": shipping.value.country,
        "ship_phone": shipping.value.phone
    }

    try {
        // Validate required fields before submitting
        if(customer.value.name == '') { errorToast('Please enter customer name'); return; }
        if(customer.value.address == '') { errorToast('Please enter customer address'); return; }
        if(customer.value.city == '') { errorToast('Please enter customer city'); return; }
        if(customer.value.state == '') { errorToast('Please enter customer state'); return; }
        if(customer.value.postcode == '') { errorToast('Please enter customer postcode'); return; }
        if(customer.value.country == '') { errorToast('Please enter customer country'); return; }
        if(customer.value.phone == '') { errorToast('Please enter customer phone'); return; }
        if(customer.value.fax == '') { errorToast('Please enter customer fax'); return; }
        if(shipping.value.name == '') { errorToast('Please enter shipping name'); return; }
        if(shipping.value.address == '') { errorToast('Please enter shipping address'); return; }
        if(shipping.value.city == '') { errorToast('Please enter shipping city'); return; }
        if(shipping.value.state == '') { errorToast('Please enter shipping state'); return; }
        if(shipping.value.postcode == '') { errorToast('Please enter shipping postcode'); return; }
        if(shipping.value.country == '') { errorToast('Please enter shipping country'); return; }
        if(shipping.value.phone == '') { errorToast('Please enter shipping phone'); return; }

        loading.value = true; // Set loading to true while waiting for the request

        let res = await axios.post('/update-or-create-customerProfile', postBody); // Sending the profile data to the server
        if(res.data.msg == true) {
            successToast('Profile updated successfully!'); // Show success message
        }

    } catch (error) {
        const errorMessage = error.response?.data?.data || "An error occurred. Please try again."; // Handling error responses
        errorToast(errorMessage); // Show error message
    } finally {
        loading.value = false; // Reset loading state
    }
}

// *******************************************************
</script>


<template>
<div class="container-fluid">

    <!-- Card for Customer Information -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Customer Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4" v-for="(value, key) in customer" :key="key">
                    <label :for="key" class="form-label">{{ key.replace('_', ' ').toUpperCase() }}*</label>
                    <input :readonly="loading" type="text" :id="key" class="form-control form-control-lg" v-model="customer[key]" />
                </div>
            </div>
        </div>
    </div>

    <!-- Card for Shipping Information -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Shipping Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4" v-for="(value, key) in shipping" :key="key">
                    <label :for="key" class="form-label">{{ key.replace('_', ' ').toUpperCase() }}*</label>
                    <input :readonly="loading" type="text" :id="key" class="form-control form-control-lg" v-model="shipping[key]" />
                </div>
            </div>
        </div>
    </div>

    <!-- Save Changes Button -->
    <div class="row">
        <div class="col-12 text-center">
            <button @click="ProfileCreateOrUpdate" class="mb-4 btn btn-success btn-lg shadow-lg" :disabled="loading">
                <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                <span v-else>Save Changes</span>
            </button>
        </div>
    </div>

</div>
</template>

<style scoped>
.card-header {
    border-radius: 10px 10px 0 0;
    font-weight: 600;
}

.card-body {
    border-radius: 0 0 10px 10px;
}

.form-control {
    border-radius: 8px;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
    font-size: 1.1rem;
}

.btn-success {
    background-color: #28a745;
    border-color: #28a745;
    padding: 12px 30px;
    border-radius: 50px;
}

.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}
</style>
