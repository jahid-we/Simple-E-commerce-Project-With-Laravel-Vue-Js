<script setup>
import { ref } from "vue"; // Import ref from Vue for reactive variables
import axios from "axios"; // Import axios for API requests

// Reactive variables
const email = ref(""); // Holds the email input
const loading = ref(false); // Controls the loading state

// Login function
const login = async () => {
    // Trim email input to remove extra spaces and check if empty
    if (!email.value.trim()) {
        errorToast("Please enter your email");
        return;
    }

    loading.value = true; // Set loading state to prevent multiple clicks
    try {
        // Send login request with email
        const res = await axios.post(`/user-login/${email.value.trim()}`);

        // If login is successful
        if (res.data.msg === true) {
            localStorage.setItem("email", email.value); // Store email in local storage
            successToast("OTP sent to your email"); // Show success message

            // Redirect to verification page after 1 second
            setTimeout(() => window.location.href = "/verify", 1000);
        } else {
            errorToast(res.data.data); // Show error message from API response
        }
    } catch (error) {
        // Handle any API errors and display a meaningful message
        errorToast(error.response?.data?.data || "An error occurred. Please try again.");
    } finally {
        loading.value = false; // Reset loading state
    }
};

// Back button function
const back = () => {
    if (!loading.value) window.history.back(); // Prevent navigation while loading
};
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

                        <!-- Email Input Field -->
                        <div class="form-group mb-3">
                            <input v-model="email" type="email" required class="form-control" placeholder="Your Email" :readonly="loading">
                        </div>

                        <!-- Login Button -->
                        <div class="form-group mb-3">
                            <button @click="login" type="submit" class="btn btn-fill-out btn-block" :disabled="loading">
                                <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                                <span v-else>Login</span>
                            </button>
                        </div>

                        <!-- Back Button -->
                        <button @click="back" type="submit" class="btn btn-fill-out btn-block" :disabled="loading">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
