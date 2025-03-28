<script setup>
import { ref } from "vue";
import axios from "axios";
const otp = ref("");
const loading = ref(false);
const verify = async () => {
    loading.value = true;
    try {
        let email = localStorage.getItem("email");
        if(!email) {
            // alert("❌ Email not found");
            errorToast(" Email not found");
            return;
        }else if(!otp.value) {
            // alert("❌ Please enter verification code");
            errorToast(" Please enter verification code");
            return;
        }else if(otp.value.length !== 6) {
            // alert("❌ Verification code must be 6 digits");
            errorToast(" Verification code must be 6 digits");
            return;
        }
        let res = await axios.post(`/verify-otp/${email}/${otp.value}`);
        if (res.data.msg === true) {
            // alert("✅ Verification successful");
            successToast("Verification successful");
            setTimeout(() => {
                if(sessionStorage.getItem("last_location")){
                        window.location.href=sessionStorage.getItem("last_location")
                    }
                    else{
                        window.location.href="/"
                    }
            },1000);
        }
    } catch (error) {
        // alert(error.response.data.data);
        errorToast(error.response.data.data);
    }finally {
        loading.value = false;
    }
}

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
                            <h3>Verification</h3>
                        </div>
                            <div class="form-group mb-3">
                                <input :readonly="loading" id="code" v-model="otp" type="text" required class="form-control" name="email" placeholder="Verification Code">
                            </div>
                            <div class="form-group mb-3">
                                <button @click="verify" type="submit" class="btn btn-fill-out btn-block" name="login" :disabled="loading">
                                    <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                                    <span v-else>Verify</span>
                                </button>
                            </div>
                            <button @click="back" type="submit" class="btn btn-fill-out btn-block" name="login">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style scoped>

</style>
