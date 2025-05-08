<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use App\Models\Category;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index', ['categories' => Category::all(), 'products' => Product::all()]);
});

Route::get('/about-us', function () {
    return view('about-us');
});

Route::get('/detail/{product:slug}', function (Product $product) {
    return view('detail', ['product' => $product, 'products' => Product::all()->except($product->id), 'categories' => Category::all()]); 
});

Route::get('/chat', function () {
    return view('chat');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/index_guest', function () {
    return view('index_guest', ['categories' => Category::all(), 'products' => Product::all()]);
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/search', function () {
    return view('search');
});

Route::get('/sign-in', function () {
    return view('sign-in');
});

Route::get('/sign-up', function () {
    return view('sign-up');
});

Route::get('/status', function () {
    return view('status');
});

Route::get('/term', function () {
    return view('term');
});

Route::get('/transaksi', function () {
    return view('transaksi');
});

Route::get('/dashboard/dashboard', function () {
    return view('dashboard/dashboard');
});

Route::get('/dashboard/orders', function () {
    return view('dashboard/orders');
});

Route::get('/dashboard/store', function () {
    return view('dashboard/store');
});

Route::get('/dashboard/users', function () {
    return view('dashboard/users');
});