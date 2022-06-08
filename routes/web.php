<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\User;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Logout;
use App\Http\Controllers\Blog;

use App\Http\Controllers\Product;
use App\Http\Controllers\Cart;

// 1. Home
Route::get('/', [Home::class, 'Home']);
Route::get('/home-list', [Home::class, 'Lists']);
Route::get('/home-add', [Home::class, 'Add']);
Route::get('/home-edit', [Home::class, 'Edit']);
Route::get('/home-delete', [Home::class, 'Delete']);


// 2. Quản lí người dùng
Route::get('/user/{start?}', [User::class, 'Lists']);
Route::get('/user-add', [User::class, 'Add']);
Route::post('/user-add', [User::class, 'postAdd']);
Route::get('/user-edit/{id?}', [User::class, 'Edit']);
Route::post('/user-edit/{id?}', [User::class, 'postUserEdit']);
Route::get('/user-delete/{id?}', [User::class, 'Delete']);

// 3. Quản lí blog

Route::prefix('blog')->group(function () {

  // Blog
  Route::get('/', [Blog::class, 'getBlog']);
  Route::post('/', [Blog::class, 'postBlog']);

  // Detail Blog
  Route::get('/detail-blog/{id?}', [Blog::class, 'getDetailBlog']);
  Route::get('/edit-detail-blog/{id?}', [Blog::class, 'getEditDetailBlog']);
  Route::post("/edit-detail-blog/{id?}", [Blog::class, "postEditDetailBlog"]);
  Route::get('/delete/{id?}', [Blog::class, 'deleteBlog']);

  // Comment
  Route::post('/comment-detail-blog', [Blog::class, 'commentDetailBlog']);
  Route::get('/delete-comment/{id?}/{page?}', [Blog::class, 'getDeleteComment']);
  Route::get('/edit-comment/{id?}/{page?}', [Blog::class, 'getEditComment']);
  Route::post('/edit-comment/{id?}/{page?}', [Blog::class, 'postEditComment']);
});

// 4. Quản lí sản phẩm
Route::prefix('product')->group(function () {
  Route::get('/', [Product::class, 'AddProduct']);
  Route::post('/', [Product::class, 'PostAddProduct']);
  Route::get('/detail-product/{id?}',[Product::class,"getDetailProduct"]);
  Route::get('/delete/{id?}', [Product::class, 'DeleteProduct']);
  Route::get('/edit/{id?}', [Product::class, 'getEditProduct']);
  Route::post('/edit/{id?}', [Product::class, 'postEditProduct']);
});

// 5. Giỏ hàng
Route::prefix("cart")->group(function () {
  Route::get("/", [Cart::class, 'getCart']);
  Route::post("/add-product", [Cart::class, 'postAddProduct']);
  Route::post("/delete-product", [Cart::class, "postDeleteProduct"]);
  Route::post('/pay-product', [Cart::class, "postPayProduct"]);
  Route::get('/history-product',[Cart::class,"getHistoryProduct"]);
});

// Đăng nhập
Route::prefix('login')->group(function () {

  Route::get('/', [Auth::class, 'getLogin']);
  Route::post('/', [Auth::class, 'postLogin']);
});
Route::get('/logout', [Logout::class, 'LogOUT']);
// Đăng xuất

// Đăng ký
Route::get('/register', [Auth::class, 'Register']);
Route::post('/register', [Auth::class, 'AddRegister']);

// Form gửi email để đổi mật khẩu
Route::get('/forgot', [Auth::class, 'Forgot']);
Route::post('/forgot', [Auth::class, 'postForgot']);

// Gửi email nhập lại mật khẩu
Route::get('/reset/{token?}', [Auth::class, 'Reset']);
Route::post('/reset/{token?}', [Auth::class, 'PostReset']);

// Active tài khoản
Route::get('/active/{token?}', [Auth::class, 'Active']);
