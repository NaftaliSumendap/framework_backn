<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminOrderController; // Pastikan ini hanya satu kali
use App\Http\Controllers\DashboardController; // Pastikan ini hanya satu kali

use App\Models\Cart;
use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;
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

// Routes for authenticated users
Route::middleware('auth')->group(function () {

    // Profile Update (AJAX)
    Route::post('/profile/update-ajax', [UserController::class, 'updateField'])->name('profile.update.ajax');

    // Home Page
    Route::get('/', function () {
        return view('index', [
            'categories' => Category::all(),
            'products' => Product::all(),
            'reviews' => Review::all()
        ]);
    })->name('index');

    // Static Pages
    Route::get('/about-us', fn() => view('about-us'));
    Route::get('/privacy', fn() => view('privacy'));
    Route::get('/term', fn() => view('term'));

    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index'); // Gunakan metode index dari ChatController
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');


    // Product Detail
    Route::get('/detail/{product:slug}', function (Product $product) {
        return view('detail', [
            'product' => $product,
            'products' => Product::all()->except($product->id),
            'categories' => Category::all(),
            'reviews' => Review::where('product_id', $product->id)->get()
        ]);
    })->name('detail');

    // Cart
    Route::get('/cart', function () {
        $user_id = Auth::id();
        return view('cart', [
            'carts' => Cart::with('product')->where('user_id', $user_id)->get(),
            'products' => Product::all(),
            'categories' => Category::all()
        ]);
    })->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Product Reviews
    Route::post('/reviews/{product}', [ReviewController::class, 'store'])->name('reviews.store');

    // Search
    Route::get('/search', [ProductController::class, 'search'])->name('search');
    Route::get('/search/kategori={category:slug}', function (Category $category) {
        $products = Product::where('category_id', $category->id)->get();
        return view('search', [
            'products' => $products,
            'categories' => Category::all(),
            'category' => $category,
            'query' => $category->name
        ]);
    })->name('search.category');

    // Checkout & Order (User Side)
    Route::get('/transaksi', [OrderController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/transaksi/process', [OrderController::class, 'processOrder'])->name('checkout.process');

    // My Orders List (User Side)
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my.orders.index');

    // Order Status Detail (User Side)
    Route::get('/status/{order}', function (Order $order) {
        return view('status', ['order' => $order]);
    })->name('status.order');

    // Logout
    Route::get('/logout', [Authentication::class, 'logout'])->name('logout.get'); // Memberi nama agar tidak ambigu dengan POST
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/sign-in'); // Redirect ke sign-in, bukan index_guest
    })->name('logout');


    // Admin Panel Routes (Middleware 'role:admin')
    Route::middleware('role:admin')->group(function () {
        // Dashboard Home
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Orders Management
        Route::get('/dashboard/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index'); // Rute utama admin orders
        Route::post('/dashboard/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
        Route::delete('/dashboard/orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy'); // Admin review delete

        // Store (Product Management)
        Route::get('/dashboard/store', [ProductController::class, 'adminIndex'])->name('admin.store.index'); // Admin product list
        Route::get('/dashboard/store/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/dashboard/store', [ProductController::class, 'store'])->name('dashboard.store');
        Route::put('/dashboard/products/{product}', [ProductController::class, 'update'])->name('products.update'); // Prefix for admin products
        Route::delete('/dashboard/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); // Prefix for admin products

        // Users Management
        Route::get('/dashboard/users', [UserController::class, 'adminIndex'])->name('admin.users.index'); // Admin user list
        Route::post('/dashboard/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/dashboard/users/{user}', [UserController::class, 'update'])->name('users.update'); // Prefix for admin users
        Route::delete('/dashboard/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Prefix for admin users

        // Category Management (Resource Controller)
        Route::resource('dashboard/categories', CategoryController::class)->except(['show', 'create']);
    });
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/sign-in', [Authentication::class, 'login'])->name('login');
    Route::post('/sign-in', [Authentication::class, 'autentikasi']);
    Route::get('/sign-up', [Authentication::class, 'register'])->name('register');
    Route::post('/sign-up', [Authentication::class, 'createuser']);

    Route::get('/auth-google-redirect', [Authentication::class, 'google_redirect']);
    Route::get('/auth-google-callback', [Authentication::class, 'google_callback']);

    Route::get('/index_guest', function () {
        return view('index_guest', [
            'categories' => Category::all(),
            'products' => Product::all()
        ]);
    })->name('index.guest'); // Beri nama rute ini juga
});
