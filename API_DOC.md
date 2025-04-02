# **E-Commerce API Route Documentation**

## **Introduction**
This document outlines the API routes for the eCommerce project, detailing authentication, product management, order processing, and other key functionalities. Each route is associated with a specific controller and, where necessary, requires authentication using token verification.

---

## **Authentication Routes**
These routes handle user authentication, login, OTP verification, and logout functionality.

- `POST /user-login/{email}` - Authenticate user using email.
- `POST /verify-otp/{email}/{otp}` - Verify OTP for authentication.
- `GET /logout` - Logout user (requires authentication).

---

## **Brand Management Routes**
Manage product brands, including retrieval, creation, updating, and deletion (admin-only for modifications).

- `GET /brand-list` - Retrieve all available brands.
- `GET /brand-by-id/{brandId}` - Retrieve brand details by ID.
- `POST /add-brand` - Add a new brand (Admin only).
- `POST /update-brand/{brandId}` - Update an existing brand (Admin only).
- `DELETE /delete-brand/{brandId}` - Delete a brand (Admin only).

---

## **Category Management Routes**
Manage product categories, including retrieval, creation, updating, and deletion.

- `GET /category-list` - Retrieve all product categories.
- `GET /category-by-id/{categoryId}` - Retrieve category details by ID.
- `POST /add-category` - Add a new category (Admin only).
- `POST /update-category/{categoryId}` - Update an existing category (Admin only).
- `DELETE /delete-category/{categoryId}` - Delete a category (Admin only).

---

## **Customer Profile Routes**
Manage customer profiles with authentication.

- `POST /customer-profile/{userId}` - Retrieve profile details for a specific user.
- `GET /customer-profile-by-id` - Retrieve profile details for the authenticated user.
- `POST /update-or-create-customerProfile` - Create or update customer profile.
- `POST /delete-customer-profile` - Delete customer profile.

---

## **Product Routes**
Retrieve products based on various criteria.

- `GET /product-by-remark/{remark}` - Retrieve products by remark.
- `GET /product-by-category/{categoryId}` - Retrieve products by category.
- `GET /product-by-brand/{brandId}` - Retrieve products by brand.

---

## **Product Review Routes**
Manage product reviews, requiring authentication for posting and modifications.

- `POST /product-review/{productId}` - Retrieve product reviews by product ID.
- `POST /add-product-review` - Add a product review (Authenticated users only).
- `POST /update-product-review` - Update an existing review.
- `POST /delete-product-review` - Delete a product review.

---

## **Product Slider Routes**
Retrieve product slider data.

- `GET /getProductSlider` - Retrieve product slider details.

---

## **Product Detail Routes**
Retrieve detailed product information.

- `GET /ProductDetailsById/{productId}` - Retrieve product details by product ID.

---

## **Product Wishlist Routes**
Manage customer wishlist, requiring authentication.

- `GET /product-wish` - Retrieve list of products in wishlist.
- `POST /add-product-wish/{productId}` - Add product to wishlist.
- `POST /delete-product-wish/{id}` - Remove product from wishlist.

---

## **Product Cart Routes**
Manage shopping cart functionalities with authentication.

- `GET /product-cart` - Retrieve list of products in cart.
- `POST /add-product-cart` - Add product to cart.
- `POST /delete-product-cart/{productId}` - Remove product from cart.

---

## **Invoice Routes**
Handle invoice creation and retrieval.

- `GET /create-invoice` - Create an invoice for a purchase.
- `GET /get-invoices` - Retrieve list of invoices.
- `POST /get-invoice-product/{invoice_id}` - Retrieve products linked to an invoice.

---

## **Payment Routes**
Process payments and handle responses.

- `POST /payment-success` - Handle successful payment response.
- `POST /payment-fail` - Handle failed payment response.
- `POST /payment-cancel` - Handle canceled payment response.

---

## **VAT Routes**
Manage VAT-related operations with authentication.

- `GET /get-vat` - Retrieve VAT details.
- `POST /add-vat` - Add or update VAT.

---

## **Page Routes**
Manage frontend pages for authentication, products, and user profile.

### **Homepage Routes**
- `GET /` - Load homepage.

### **Authentication Page Routes**
- `GET /login` - Load login page.
- `GET /verify` - Load OTP verification page.

### **Product Page Routes**
- `GET /ByCategory` - Display products by category.
- `GET /ByBrand` - Display products by brand.
- `GET /ProductDetails` - Display product details.
- `GET /ProductWishPage` - Display wishlist page.
- `GET /ProductCartPage` - Display cart page.

### **User Profile Page Routes**
- `GET /profile` - Display user profile page.

---

## **Conclusion**
This document provides a structured overview of the API routes used in the eCommerce project, ensuring clarity and ease of reference for developers and stakeholders.

