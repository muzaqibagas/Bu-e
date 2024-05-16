<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\biaya;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;

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

// Rute untuk admin
Route::get('/admin-login', [AuthController::class, 'showAdminLoginForm'])->name('admin-login');
Route::post('/admin-login', [AuthController::class, 'adminLogin']);
Route::get('/admin-signup', [AuthController::class, 'showAdminSignupForm'])->name('admin-signup');
Route::post('/admin-signup', [AuthController::class, 'adminSignup']);

// Rute untuk user
Route::get('/login', [AuthController::class, 'showUserLoginForm'])->name('user-login');
Route::post('/login', [AuthController::class, 'userLogin']);
Route::get('/signup', [AuthController::class, 'showUserSignupForm'])->name('user-signup');
Route::post('/signup', [AuthController::class, 'userSignup']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk dashboard admin
Route::get('admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

// Rute untuk dashboard pengguna (user)
Route::permanentRedirect('/', '/home');
Route::get('/home', [DashboardController::class, 'userDashboard'])->name('user.dashboard');

//dashboard admin
Route::get('/dashboard', [DashboardController::class, 'loadDashboard']);
Route::get('/biaya',[DashboardController::class,'loadBiaya']);
Route::get('/product',[DashboardController::class,'loadProducts']);
Route::get('/category',[DashboardController::class,'loadCategories']);
Route::get('/admin',[DashboardController::class,'loadAdmin']);
Route::get('/cart',[DashboardController::class,'loadCart']);
Route::get('/total-products', [ProductController::class, 'getTotalProducts'])->name('total-products');

//dashboard user
Route::get('/home', [DashboardController::class, 'loadUserDashboard']);
Route::get('/menu',[DashboardController::class,'loadMenu']);

Route::get('/user/profile', [AuthController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::get('/user-logout', [AuthController::class, 'userlogout'])->name('user.logout');
// Rute untuk menampilkan form edit profil
Route::get('/user/profile/edit', [AuthController::class, 'editProfileForm'])->name('user.edit-profile-form');

// Rute untuk menyimpan perubahan pada profil pengguna
Route::post('/user/profile/update', [AuthController::class, 'updateProfile'])->name('user.update-profile');

//download pdf
// Route untuk menampilkan halaman biaya
Route::get('/biaya', [BiayaController::class, 'index'])->name('biaya.index');

// Route untuk mendownload PDF tunggal berdasarkan ID
Route::get('/biaya/download/{id}', [BiayaController::class, 'downloadPDF'])->name('download.pdf');

// Route untuk mendownload semua PDF
Route::get('/biaya/download-all', [BiayaController::class, 'downloadAllPDF'])->name('download.all.pdf');

//biaya
Route::get('/biaya', [BiayaController::class, 'index'])->name('index');
Route::get('/biaya/{id}/edit', [BiayaController::class, 'edit'])->name('biaya.edit');
Route::put('/biaya/{id}', [BiayaController::class, 'update'])->name('biaya.update');
Route::delete('/biaya/{id}', [BiayaController::class, 'delete'])->name('biaya.delete');
// Rute untuk menampilkan formulir penambahan data
Route::get('/biaya/create', [BiayaController::class, 'create'])->name('biaya.create');
Route::get('/show-income', [BiayaController::class, 'showIncome'])->name('show-income');
Route::get('/show-expense', [BiayaController::class, 'showExpense'])->name('show-expense');



// Rute untuk menangani permintaan POST dari formulir penambahan data
Route::post('/biaya', [BiayaController::class, 'store'])->name('biaya.store');
Route::get('/dashboard', [BiayaController::class, 'ChartDashboard'])->name('dashboard');
// Route::get('/admin/chart', [adminController::class, 'adminChart'])->name('admin.chart');
Route::get('/download/filtered/pdf', [BiayaController::class, 'downloadFilteredPDF'])->name('download.filtered.pdf');
Route::get('/home/menu', [ProductController::class, 'loadProduct'])->name('user.dashboard');
Route::get('/home', [ProductController::class, 'takeProduct'])->name('home.dashboard');


//product
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit',[ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('products.delete');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.detail');



//category
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

//admin
Route::get('/admins', [adminController::class, 'index'])->name('admins.index');
Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit');
Route::put('/admins/{id}', [AdminController::class, 'update'])->name('admins.update');
Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');

//cart
// Rute untuk menambahkan produk ke keranjang belanja
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');


// Rute untuk menampilkan halaman keranjang belanja
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::get('/carts/downloadPDF/{id}', [CartController::class, 'downloadPDF'])->name('carts.downloadPDF');
// Definisi rute untuk menandai pesanan sebagai selesai dan menghapusnya dari keranjang
Route::post('/cart/{id}/finish', [CartController::class, 'markAsFinished'])->name('cart.markAsFinished');


Route::get('/total-sales', [CartController::class, 'getTotalSales']);

