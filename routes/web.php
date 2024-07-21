<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MemberLoginController;
use App\Http\Controllers\Frontend\MemberRegisterController;
use App\Http\Controllers\Frontend\MemberBlogController;
use App\Http\Controllers\Frontend\MemberAccountController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\FeedBackController;
use App\Http\Controllers\MailController;


Route::get('/member/register', [MemberRegisterController::class, 'index']);
Route::post('/member/register', [MemberRegisterController::class, 'store']);
Route::get('/member/login', [MemberLoginController::class, 'index']);
Route::post('/member/login', [MemberLoginController::class, 'login']);
Route::get('/member/logout', [MemberLoginController::class, 'logout']);
Route::get('/', [HomeController::class, 'index']);
// Protected routes
Route::group(['middleware' => ['member']], function () {

    Route::get('/member/blog', [MemberBlogController::class, 'index']);
    Route::get('/member/blog_single/{id}', [MemberBlogController::class, 'show'])->name('blog.single');
    Route::post('/save-rating', [MemberBlogController::class, 'saveRating'])->name('save-rating');
    Route::post('/post-comment', [MemberBlogController::class, 'postComment'])->name('post-comment');

    Route::get('/member/account/update', [MemberAccountController::class, 'index']);
    Route::post('/member/account/update', [MemberAccountController::class, 'update']);
    Route::get('/member/account/product', [MemberAccountController::class, 'show']);
    Route::get('/member/account/add_product', [MemberAccountController::class, 'create'])->name('add_product');
    Route::post('/member/account/add_product', [MemberAccountController::class, 'store']);
    Route::get('/member/account/edit_product/{id}', [MemberAccountController::class, 'edit'])->name('edit_product');
    Route::post('/member/account/update_product/{id}', [MemberAccountController::class, 'updateProduct'])->name('update_product');
    Route::get('/member/account/delete_product/{id}', [MemberAccountController::class, 'destroy'])->name('delete_product');
    Route::get('/member/account/product/{id}', [HomeController::class, 'show'])->name('product.detail');

    Route::get('/add-cart', [CartController::class, 'addToCart'])->name('add-cart');
    Route::get('/yourCart', [CartController::class, 'show']);
    Route::get('/cart-delete/{id}', [CartController::class, 'destroy']);
    Route::post('/update-cart-session', [CartController::class, 'updateCartSession'])->name('cart.update-session');
    Route::get('/search', [SearchController::class, 'searchProduct']);
    Route::get('/search_advanced', [SearchController::class, 'index'])->name('search.advanced.form');
    Route::post('/search_advanced', [SearchController::class, 'searchProductAdvanced'])->name('search.product.advanced');
    Route::get('/filter-products', [SearchController::class, 'filterProducts']);

    Route::get('/feedback', [FeedbackController::class, 'showForm'])->name('feedback.form');
    Route::post('/feedback', [FeedbackController::class, 'sendFeedback'])->name('feedback.send');
    
    Route::post('/yourCart', [MailController::class, 'sendMail']);
});


Auth::routes();


Route::group([
    'middleware'=> ['admin']
], function (){
//required login


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', [DashboardController::class, 'index']);

Route::get('/admin/user/update', [UserController::class, 'index']);
Route::post('/admin/user/update', [UserController::class, 'update']);

Route::get('/admin/country/list', [CountryController::class, 'index']);
Route::get('/admin/country/add', [CountryController::class, 'create'])->name('create.country');
Route::post('/admin/country/add', [CountryController::class, 'store'])->name('add.country');
Route::get('/admin/country/edit/{id}', [CountryController::class, 'edit'])->name('edit.country');
Route::post('/admin/country/edit/{id}', [CountryController::class, 'update'])->name('update.country');
Route::get('/admin/country/delete/{id}', [CountryController::class, 'destroy'])->name('delete.country');

Route::get('/admin/blog/list', [BlogController::class, 'index']);
Route::get('/admin/blog/add', [BlogController::class, 'create'])->name('create.blog');
Route::post('/admin/blog/add', [BlogController::class, 'store'])->name('add.blog');
Route::get('/admin/blog/edit/{id}', [BlogController::class, 'edit'])->name('edit.blog');
Route::post('/admin/blog/edit/{id}', [BlogController::class, 'update'])->name('update.blog');
Route::get('/admin/blog/delete/{id}', [BlogController::class, 'destroy'])->name('delete.blog');

Route::get('/admin/category/list', [CategoryController::class, 'index']);
Route::get('/admin/category/add', [CategoryController::class, 'create'])->name('create.category');
Route::post('/admin/category/add', [CategoryController::class, 'store']);
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('edit.category');
Route::post('/admin/category/edit/{id}', [CategoryController::class, 'update'])->name('update.category');
Route::get('/admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('delete.category');

Route::get('/admin/brand/list', [BrandController::class, 'index']);
Route::get('/admin/brand/add', [BrandController::class, 'create'])->name('create.brand');
Route::post('/admin/brand/add', [BrandController::class, 'store']);
Route::get('/admin/brand/edit/{id}', [BrandController::class, 'edit'])->name('edit.brand');
Route::post('/admin/brand/edit/{id}', [BrandController::class, 'update'])->name('update.brand');
Route::get('/admin/brand/delete/{id}', [BrandController::class, 'destroy'])->name('delete.brand');

});


