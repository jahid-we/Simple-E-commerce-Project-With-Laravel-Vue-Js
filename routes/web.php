<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TokenVerification;
use App\Http\Controllers\brand\brandController;
use App\Http\Controllers\payment\vatController;
use App\Http\Controllers\Page\HomepageController;
use App\Http\Controllers\invoice\invoiceController;
use App\Http\Controllers\product\productController;
use App\Http\Controllers\category\categoryController;
use App\Http\Controllers\payment\sslcommerzController;
use App\Http\Controllers\authentication\authController;
use App\Http\Controllers\product\productCartController;
use App\Http\Controllers\product\productWishController;
use App\Http\Controllers\product\productDetailController;
use App\Http\Controllers\product\productReviewController;
use App\Http\Controllers\product\productSliderController;
use App\Http\Controllers\invoice\invoiceProductController;
use App\Http\Controllers\Page\authPages\authPageController;
use App\Http\Controllers\Page\userPages\userProfileController;
use App\Http\Controllers\Page\productPages\productPageController;
use App\Http\Controllers\customerProfile\customerProfileController;

// =====================================================
// =============== Authentication Routes ===============
// =====================================================
Route::controller(authController::class)->group(function () {
    Route::post('/user-login/{email}', 'userLogin'); // Authenticate user using email
    Route::post('/verify-otp/{email}/{otp}', 'verifyOTP'); // Verify OTP for authentication
    Route::middleware([TokenVerification::class])->get('/logout', 'logout'); // Logout user (requires authentication)
});

// =====================================================
// =============== Brand Management Routes =============
// =====================================================
Route::controller(brandController::class)->group(function () {
    Route::get('/brand-list','getBrands'); // Retrieve list of all available brands
    Route::get('/brand-by-id/{brandId}', 'getBrandById'); // Retrieve brand details by ID
    Route::middleware([TokenVerification::class])->group(function () {
        Route::post('/add-brand', 'addBrand'); // Add a new brand (Admin only)
        Route::post('/update-brand/{brandId}', 'updateBrand'); // Update an existing brand (Admin only)
        Route::delete('/delete-brand/{brandId}', 'deleteBrand'); // Delete a brand (Admin only)
    });
});


// =====================================================
// =============== Category Management Routes ==========
// =====================================================
Route::controller(categoryController::class)->group(function () {
    Route::get('/category-list', 'getCategory'); // Retrieve list of all product categories
    Route::get('/category-by-id/{categoryId}', 'getCategoryById'); // Retrieve category details by ID
    Route::middleware([TokenVerification::class])->group(function () {
        Route::post('/add-category', 'addCategory'); // Add a new category (Admin only)
        Route::post('/update-category/{categoryId}', 'updateCategory'); // Update an existing category (Admin only)
        Route::delete('/delete-category/{categoryId}', 'deleteCategory'); // Delete a category (Admin only)
    });
});


// =====================================================
// ============= Customer Profile Routes ===============
// =====================================================
Route::controller(customerProfileController::class)->middleware([TokenVerification::class])->group(function () {
    Route::post('/customer-profile/{userId}', 'getCustomerProfile'); // Retrieve profile details for a specific user
    Route::get('/customer-profile-by-id', 'getCustomerProfileById'); // Retrieve profile details for the authenticated user
    Route::post('/update-or-create-customerProfile', 'updateOrCreateCustomerProfile'); // Create or update customer profile
    Route::post('/delete-customer-profile', 'deleteCustomerProfile'); // Delete customer profile
});


Route::controller(productController::class)->group(function () {
   Route::get('/product-by-remark/{remark}', 'remarkProduct');
   Route::get('/product-by-category/{categoryId}','ListProductByCategory');
   Route::get('/product-by-brand/{brandId}','ListProductByBrand');
});



// =====================================================
// ============== Product Review Routes ================
// =====================================================
Route::controller(productReviewController::class)->group(function () {
    Route::post('/product-review/{productId}', 'getProductReviewByProductId'); // Retrieve product reviews by product ID
    Route::middleware([TokenVerification::class])->group(function () {
        Route::post('/add-product-review', 'addProductReview'); // Add a product review (Authenticated users only)
        Route::post('/update-product-review', 'updateProductReview'); // Update an existing review (Authenticated users only)
        Route::post('/delete-product-review', 'deleteProductReview'); // Delete a product review (Authenticated users only)
    });
});

// =====================================================
// ============== Product Slider Routes ================
// =====================================================
Route::controller(productSliderController::class)->group(function () {

    Route::get('/getProductSlider','getProductSlider'); // Retrieve product reviews by product ID

});


// =====================================================
// ============== Product Detail Routes ================
// =====================================================
Route::controller(productDetailController::class)->group(function () {

    Route::get('/ProductDetailsById/{productId}','ProductDetailsById'); // Retrieve product reviews by product ID

});

// =====================================================
// ============== Product Wishlist Routes ==============
// =====================================================
Route::controller(productWishController::class)->middleware([TokenVerification::class])->group(function () {
    Route::get('/product-wish', 'getProductWish'); // Retrieve list of products in wishlist
    Route::post('/add-product-wish/{productId}', 'addProductWish'); // Add product to wishlist
    Route::post('/delete-product-wish/{id}', 'deleteProductWish'); // Remove product from wishlist
});

// =====================================================
// ================== Product Cart Routes ==============
// =====================================================
Route::controller(productCartController::class)->middleware([TokenVerification::class])->group(function () {
    Route::get('/product-cart', 'getProductCart'); // Retrieve list of products in cart
    Route::post('/add-product-cart', 'addProductCart'); // Add product to cart
    Route::post('/delete-product-cart/{productId}', 'deleteProductCart'); // Remove product from cart
});

// =====================================================
// ==================== Invoice Routes =================
// =====================================================
Route::controller(invoiceController::class)->middleware([TokenVerification::class])->group(function () {
    Route::get('/create-invoice', 'createInvoice'); // Create an invoice for a purchase
    Route::get('/get-invoices', 'getInvoice'); // Retrieve list of invoices
});

Route::controller(invoiceProductController::class)->middleware([TokenVerification::class])->group(function () {
    Route::post('/get-invoice-product/{invoice_id}', 'getInvoiceProduct'); // Retrieve products linked to an invoice
});

// =====================================================
// ================== Payment Routes ===================
// =====================================================
Route::controller(sslcommerzController::class)->group(function () {
    Route::post('/payment-success', 'PaymentSuccess'); // Handle successful payment response
    Route::post('/payment-fail', 'PaymentFail'); // Handle failed payment response
    Route::post('/payment-cancel', 'PaymentCancel'); // Handle canceled payment response
});

// =====================================================
// ================== VAT Routes =======================
// =====================================================
Route::controller(vatController::class)->middleware([TokenVerification::class])->group(function () {
    Route::get('/get-vat', 'getVat'); // Retrieve VAT details
    Route::post('/add-vat', 'updateOrCreateVat'); // Add VAT or update existing VAT
});

// =====================================================PAGES=========================================================

// =====================================================
// ================== Homepage Routes ==================
// =====================================================
Route::controller(HomepageController::class)->group(function () {
    Route::get('/', 'HomePage')->name('HomePage');

});


// =====================================================
// =============Authentication Page Routes =============
// =====================================================

Route::controller(authPageController::class)->group(function () {
    Route::get('/login', 'LoginPage')->name('login');
    Route::get('/verify', 'VerifyPage')->name('verify');

});


// =====================================================
// =============Product Page Routes ===================
// =====================================================

Route::controller(productPageController::class)->group(function () {
    Route::get('/ByCategory', 'ByCategory')->name('ByCategory');
    Route::get('/ByBrand', 'ByBrand')->name('ByBrand');
    Route::get('/ProductDetails', 'ProductDetail')->name('ProductDetail');
    Route::get('/ProductWishPage', 'ProductWishList')->name('ProductWishPage');
    Route::get('/ProductCartPage', 'ProductCart')->name('ProductCartPage');


});

// =====================================================
// ============= User Page Routes ======================
// =====================================================

Route::controller(userProfileController::class)->middleware([TokenVerification::class])->group(function () {
    Route::get('/profile', 'UserProfilePage');

});
