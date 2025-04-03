<script setup>
import { ref } from "vue"; // Import ref from Vue for reactive variables
import axios from "axios"; // Import axios to handle HTTP requests

// Reactive variables
const otp = ref(""); // Holds the OTP input value
const loading = ref(false); // Controls the loading state while waiting for a response

// Function to verify the OTP
const verify = async () => {
    loading.value = true; // Set loading state to prevent multiple clicks
    try {
        let email = localStorage.getItem("email"); // Get email from localStorage
        if(!email) { // If no email is found in localStorage
            errorToast("Email not found"); // Show an error toast
            return;
        } else if(!otp.value) { // If OTP is not entered
            errorToast("Please enter verification code"); // Show an error toast
            return;
        } else if(otp.value.length !== 6) { // If OTP is not 6 digits long
            errorToast("Verification code must be 6 digits"); // Show an error toast
            return;
        }

        // Send the OTP to the backend for verification
        let res = await axios.post(`/verify-otp/${email}/${otp.value}`);
        if (res.data.msg === true) { // If verification is successful
            successToast("Verification successful"); // Show success toast

            // Redirect user to the previous location or home page
            setTimeout(() => {
                if(sessionStorage.getItem("last_location")) {
                    window.location.href = sessionStorage.getItem("last_location");
                } else {
                    window.location.href = "/"; // Redirect to home if no last location
                }
            }, 1000);
        }
    } catch (error) {
        errorToast(error.response?.data?.data); // Show error if the API request fails
    } finally {
        loading.value = false; // Reset loading state once the request is completed
    }
};

// Back button function to navigate to the previous page
const back = () => {
    window.history.back(); // Go back to the previous page in the browser history
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
                            <h3>Verification</h3>
                        </div>

                        <!-- OTP Input Field -->
                        <div class="form-group mb-3">
                            <input :readonly="loading" id="code" v-model="otp" type="text" required class="form-control" placeholder="Verification Code">
                        </div>

                        <!-- Verify Button -->
                        <div class="form-group mb-3">
                            <button @click="verify" type="submit" class="btn btn-fill-out btn-block" :disabled="loading">
                                <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                                <span v-else>Verify</span>
                            </button>
                        </div>

                        <!-- Back Button -->
                        <button @click="back" type="submit" class="btn btn-fill-out btn-block" :disabled="loading" >Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style scoped>
/* Add your styles here */
</style>
