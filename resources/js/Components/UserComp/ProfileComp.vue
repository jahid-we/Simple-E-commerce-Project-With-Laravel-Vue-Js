<script setup>
import { ref , onMounted } from 'vue';
import axios from 'axios';

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

const shipping = ref({
    name: '',
    address: '',
    city: '',
    state: '',
    postcode: '',
    country: '',
    phone: ''
});

const getProfile = async () => {
    try {
        let res = await axios.get('/customer-profile-by-id');
        if(res.data.msg == true) {
            customer.value.name = res.data.data.cus_name;
            customer.value.address = res.data.data.cus_add;
            customer.value.city = res.data.data.cus_city;
            customer.value.state = res.data.data.cus_state;
            customer.value.postcode = res.data.data.cus_postcode;
            customer.value.country = res.data.data.cus_country;
            customer.value.phone = res.data.data.cus_phone;
            customer.value.fax = res.data.data.cus_fax;

            shipping.value.name = res.data.data.ship_name;
            shipping.value.address = res.data.data.ship_add;
            shipping.value.city = res.data.data.ship_city;
            shipping.value.state = res.data.data.ship_state;
            shipping.value.postcode = res.data.data.ship_postcode;
            shipping.value.country = res.data.data.ship_country;
            shipping.value.phone = res.data.data.ship_phone;

        }else{
            console.log(res.data.data);
        }
    }catch (error) {
        console.log(error);
    }
}

onMounted(() => {
        getProfile();
    })

// ************************************************

const ProfileCreateOrUpdate = async () => {
    let postBody={
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
           "ship_city":shipping.value.city,
           "ship_state": shipping.value.state,
           "ship_postcode": shipping.value.postcode,
           "ship_country": shipping.value.country,
           "ship_phone": shipping.value.phone
       }
    try {
        if(customer.value.name == '') {
            alert('❌ Please enter customer name');
            return;
        }else if(customer.value.address == '') {
            alert('❌ Please enter customer address');
            return;
        }else if(customer.value.city == '') {
            alert('❌ Please enter customer city');
            return;
        }else if(customer.value.state == '') {
            alert('❌ Please enter customer state');
            return;
        }else if(customer.value.postcode == '') {
            alert('❌ Please enter customer postcode');
            return;
        }else if(customer.value.country == '') {
            alert('❌ Please enter customer country');
            return;
        }else if(customer.value.phone == '') {
            alert('❌ Please enter customer phone');
            return;
        }else if(shipping.value.name == '') {
            alert('❌ Please enter shipping name');
            return;
        }else if(shipping.value.address == '') {
            alert('❌ Please enter shipping address');
            return;
        }else if(shipping.value.city == '') {
            alert('❌ Please enter shipping city');
            return;
        }else if(shipping.value.state == '') {
            alert('❌ Please enter shipping state');
            return;
        }else if(shipping.value.postcode == '') {
            alert('❌ Please enter shipping postcode');
            return;
        }else if(shipping.value.country == '') {
            alert('❌ Please enter shipping country');
            return;
        }else if(shipping.value.phone == '') {
            alert('❌ Please enter shipping phone');
            return;
        }

        let res = await axios.post('/update-or-create-customerProfile', postBody);
        if(res.data.msg == true) {
            alert ( "✅"+res.data.data || '✅ Profile updated successfully!');
        }

    }catch (error) {
        alert(error);
    }
}

// ****************************************❌ *********


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
                    <input type="text" :id="key" class="form-control form-control-lg" v-model="customer[key]" />
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
                    <input type="text" :id="key" class="form-control form-control-lg" v-model="shipping[key]" />
                </div>
            </div>
        </div>
    </div>

    <!-- Save Changes Button -->
    <div class="row">
        <div class="col-12 text-center">
            <button @click="ProfileCreateOrUpdate" class="mb-4 btn btn-success btn-lg shadow-lg">Save Changes</button>
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
