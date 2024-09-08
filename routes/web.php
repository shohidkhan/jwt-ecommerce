<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenAuthentication;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/by-category', [CategoryController::class, 'ByCategoryPage']);
Route::get('/by-brand', [BrandController::class, 'ByBrandPage']);
Route::get('/policy', [PolicyController::class, 'policy'])->name('policy');
Route::get('/product-details', [ProductController::class, 'productDetailsPage'])->name('productDetailsPage');

Route::get("/uniqueBsedOnRemark", [ProductController::class, 'uniqueBsedOnRemark']);
Route::get("/categories", [CategoryController::class, 'index'])->name('categories');
Route::get("/brands", [BrandController::class, 'index'])->name('brands');
Route::get("/ListProductSlider", [ProductController::class, 'ListProductSlider'])->name('ListProductSlider');

Route::get("/products", [ProductController::class, 'products'])->name('products');
// product by category
Route::get("/productByCategory/{id}", [ProductController::class, 'productByCategory'])->name('productByCategory');

// product by brand
Route::get("/productByBrand/{id}", [ProductController::class, 'productByBrand'])->name('productByBrand');

//product by remark
Route::get("/productByRemark/{remark}", [ProductController::class, 'productByRemark'])->name('productByRemark');

//Product details by id
Route::get("/productDetailsById/{id}", [ProductController::class, 'productDetailsById'])->name('productDetailsById');

//product Review By Product
Route::get("/listReviewByProduct/{id}", [ProductController::class, 'listReviewByProduct'])->name('listReviewByProduct');

//policy by type

Route::get("/policyByType/{type}", [PolicyController::class, 'policyByType'])->name('policyByType');

// user auth
Route::get("/userLogin/{userEmail}", [UserController::class, 'userLogin'])->name('userLogin');
Route::get("/verifyOtp/{userEmail}/{otp}", [UserController::class, 'verifyOtp'])->name('verifyOtp');
Route::get("/logout", [UserController::class, 'logout'])->name('logout');
Route::get("/userLoginPage", [UserController::class, 'userLoginPage'])->name('userLoginPage');

Route::post("/createProfile", [ProfileController::class, 'createProfile'])->name('createProfile')->middleware(TokenAuthentication::class);
Route::get("/readProfile", [ProfileController::class, 'readProfile'])->name('readProfile')->middleware(TokenAuthentication::class);

//product review
Route::post("/createProductReview", [ProductController::class, 'createProductReview'])->name('createProductReview')->middleware(TokenAuthentication::class);

//prodcut wishlist
Route::get("/productWishList", [ProductController::class, 'productWishList'])->name('productWishList')->middleware(TokenAuthentication::class);
Route::get("/createWishList/{product_id}", [ProductController::class, 'createWishList'])->name('createWishList')->middleware(TokenAuthentication::class);
Route::get("/removeWishList/{product_id}", [ProductController::class, 'removeWishList'])->name('removeWoshList')->middleware(TokenAuthentication::class);

//product cart

Route::post("/createCartList", [ProductController::class, 'createCartList'])->name('createCartList')->middleware(TokenAuthentication::class);
Route::get("/cartList", [ProductController::class, 'cartList'])->name('cartList')->middleware(TokenAuthentication::class);
Route::get("/removeCartList/{id}", [ProductController::class, 'removeCartList'])->name('removeCartList')->middleware(TokenAuthentication::class);

//Invoices Route
Route::get("/invoiceCreate", [InvoiceController::class, 'invoiceCreate'])->name('invoiceCreate')->middleware(TokenAuthentication::class);
Route::get("/invoiceList", [InvoiceController::class, 'invoiceList'])->name('invoiceList')->middleware(TokenAuthentication::class);
Route::get("/productInvoiceList/{invoice_id}", [InvoiceController::class, 'productInvoiceList'])->name('productInvoiceList')->middleware(TokenAuthentication::class);

Route::post("/PaymentSuccess", [InvoiceController::class, 'PaymentSuccess'])->name('PaymentSuccess');
Route::post("/PaymentFail", [InvoiceController::class, 'PaymentFail'])->name('PaymentFail');