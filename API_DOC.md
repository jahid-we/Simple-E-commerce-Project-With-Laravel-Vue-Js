# **E-Commerce API Route Documentation**

## **Introduction**
This document outlines the API routes for the eCommerce project, detailing authentication, product management, order processing, and other key functionalities. Each route is associated with a specific controller and, where necessary, requires authentication using **TokenVerification** middleware.

---

## **Middleware Overview**
Middleware is used to manage authentication, rate-limiting, and request validation.

- **TokenVerification**: Ensures the user is authenticated before accessing protected routes.
- **throttle:custom**: Custom rate-limiting middleware for preventing abuse of authentication routes.

---

## **Authentication Routes**
These routes handle user authentication, login, OTP verification, and logout functionality.

- `POST /user-login/{email}` - Authenticate user using email (**throttle:custom**).
- `POST /verify-otp/{email}/{otp}` - Verify OTP for authentication (**throttle:custom**).
- `GET /logout` - Logout user (**TokenVerification required**).

---

## **Brand Management Routes**
Manage product brands, including retrieval, creation, updating, and deletion (admin-only for modifications).

- `GET /brand-list` - Retrieve all available brands.
- `GET /brand-by-id/{brandId}` - Retrieve brand details by ID.
- `POST /add-brand` - Add a new brand (**TokenVerification required**).
- `POST /update-brand/{brandId}` - Update an existing brand (**TokenVerification required**).
- `DELETE /delete-brand/{brandId}` - Delete a brand (**TokenVerification required**).

---

## **Category Management Routes**
Manage product categories, including retrieval, creation, updating, and deletion.

- `GET /category-list` - Retrieve all product categories.
- `GET /category-by-id/{categoryId}` - Retrieve category details by ID.
- `POST /add-category` - Add a new category (**TokenVerification required**).
- `POST /update-category/{categoryId}` - Update an existing category (**TokenVerification required**).
- `DELETE /delete-category/{categoryId}` - Delete a category (**TokenVerification required**).

---

## **Customer Profile Routes**
Manage customer profiles with authentication.

- `POST /customer-profile/{userId}` - Retrieve profile details for a specific user (**TokenVerification required**).
- `GET /customer-profile-by-id` - Retrieve profile details for the authenticated user (**TokenVerification required**).
- `POST /update-or-create-customerProfile` - Create or update customer profile (**TokenVerification & throttle:custom required**).
- `POST /delete-customer-profile` - Delete customer profile (**TokenVerification required**).

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
- `POST /add-product-review` - Add a product review (**TokenVerification required**).
- `POST /update-product-review` - Update an existing review (**TokenVerification required**).
- `POST /delete-product-review` - Delete a product review (**TokenVerification required**).

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

- `GET /product-wish` - Retrieve list of products in wishlist (**TokenVerification required**).
- `POST /add-product-wish/{productId}` - Add product to wishlist (**TokenVerification required**).
- `POST /delete-product-wish/{id}` - Remove product from wishlist (**TokenVerification required**).

---

## **Product Cart Routes**
Manage shopping cart functionalities with authentication.

- `GET /product-cart` - Retrieve list of products in cart (**TokenVerification required**).
- `POST /add-product-cart` - Add product to cart (**TokenVerification required**).
- `POST /delete-product-cart/{productId}` - Remove product from cart (**TokenVerification required**).

---

## **Invoice Routes**
Handle invoice creation and retrieval.

- `GET /create-invoice` - Create an invoice for a purchase (**TokenVerification required**).
- `GET /get-invoices` - Retrieve list of invoices (**TokenVerification required**).
- `POST /get-invoice-product/{invoice_id}` - Retrieve products linked to an invoice (**TokenVerification required**).

---

## **Payment Routes**
Process payments and handle responses.

- `POST /payment-success` - Handle successful payment response.
- `POST /payment-fail` - Handle failed payment response.
- `POST /payment-cancel` - Handle canceled payment response.

---

## **VAT Routes**
Manage VAT-related operations with authentication.

- `GET /get-vat` - Retrieve VAT details (**TokenVerification required**).
- `POST /add-vat` - Add or update VAT (**TokenVerification required**).

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
- `GET /profile` - Display user profile page (**TokenVerification required**).

---

## **Conclusion**
This document provides a structured overview of the API routes used in the eCommerce project, ensuring clarity and ease of reference for developers and stakeholders. Middleware details are explicitly mentioned to indicate access control and rate limits.

