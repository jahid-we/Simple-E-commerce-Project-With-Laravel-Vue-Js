<script setup>
import { ref } from "vue";
import axios from "axios";

const email = ref("");
const loading = ref(false);

const login = async () => {
    loading.value = true;
    try {
        if (!email.value) {
            // alert("❌ Please enter your email");
            errorToast("Please enter your email");
            return;
        }
        let res = await axios.post(`/user-login/${email.value}`);
        if (res.data.msg === true) {
            localStorage.setItem("email", email.value);
            // alert("✅ OTP sent to your email");
            successToast("OTP sent to your email");
            setTimeout(() => {
                window.location.href = "/verify";
            },1000);
        }
    } catch (error) {
        errorToast("Error sending OTP");
        console.log("Error sending OTP");
    }finally {
        loading.value = false;
    }
};

// Back button function
const back = () => {
    window.history.back();
}
</script>

<template>
<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
                    <div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3>Login</h3>
                        </div>
                        <div class="form-group mb-3">
                            <input :readonly="loading" v-model="email" type="email" required class="form-control" placeholder="Your Email">
                        </div>
                        <div class="form-group mb-3">
                            <button @click="login" type="submit" class="btn btn-fill-out btn-block" :disabled="loading">
                            <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                            <span v-else>Login</span>
                            </button>
                        </div>
                        <button @click="back" type="submit" class="btn btn-fill-out btn-block">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style scoped></style>
