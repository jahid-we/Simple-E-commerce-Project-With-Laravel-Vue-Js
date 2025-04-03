<script setup>
import { ref, defineModel } from "vue"; // Import defineModel

// Define reactive models for modal visibility and payment methods
const showModal = defineModel("showModal");
const paymentMethod = defineModel("paymentMethod");

// Function to close the modal
const closeModal = () => {
  showModal.value = false;
};
</script>

<template>
  <!-- Modal Overlay -->
  <div v-if="showModal" class="modal-overlay">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title p-2">Pay Now</h5>
          <button type="button" class="btn-close p-2" @click="closeModal"></button>
        </div>

        <!-- Scrollable Modal Body -->
        <div class="modal-body">
          <div class="payment-list">
            <div v-for="(item, index) in paymentMethod" :key="index" class="payment-item">
              <img :src="item.logo" alt="Payment" class="payment-logo">
              <span class="payment-name">{{ item.name }}</span>
              <a :href="item.redirectGatewayURL ?? '#'" target="_blank" class="btn btn-primary btn-sm">Pay</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Modal Overlay */
.modal-overlay {
  position: fixed;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(0, 0, 0, 0.6);
  padding: 20px;
  z-index: 1050;
}

/* Modal Box */
.modal-dialog {
  background: white;
  border-radius: 8px;
  width: 100%;
  max-width: 380px;
  box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
  max-height: 90vh;
  display: flex;
  flex-direction: column;
}

/* Scrollable Body */
.modal-body {
  overflow-y: auto;
  max-height: 400px;
  padding: 25px;
}

/* Payment List */
.payment-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

/* Payment Item */
.payment-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #f8f9fa;
  padding: 10px;
  border-radius: 6px;
  transition: background 0.3s ease;
}

.payment-item:hover {
  background: #e9ecef;
}

/* Payment Logo */
.payment-logo {
  width: 40px;
  height: 40px;
  object-fit: contain;
  border-radius: 5px;
}

/* Payment Name */
.payment-name {
  flex-grow: 1;
  font-size: 0.9rem;
  font-weight: 500;
  margin-left: 10px;
}

/* Responsive */
@media (max-width: 400px) {
  .modal-dialog {
    max-width: 90%;
  }
}
</style>
