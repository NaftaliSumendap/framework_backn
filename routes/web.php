<?php
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {

    Route::get('/chat/{userId?}', [ChatController::class, 'index'])->name('chat');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    // Halaman umum yang bisa diakses admin dan user
    Route::post('/profile/update-ajax', [UserController::class, 'updateField'])->name('profile.update.ajax');

    Route::get('/', function () {
        return view('index', [
            'categories' => Category::all(),
            'products' => Product::all(),
            'reviews' => Review::all()
        ]);
    })->name('index');

    Route::get('/about-us', fn() => view('about-us'));
    Route::get('/chat', fn() => view('chat'));
    Route::get('/cart', function (Cart $cart) {
        $user_id = Auth::id();
        return view('cart', [
            'cart' => $cart,
            'carts' => Cart::with('product')->where('user_id', $user_id)->get(),
            'products' => Product::all(),
            'categories' => Category::all()
        ]);
    })->name('cart.index');

Route::get('/detail/{product:slug}', function (Product $product) {
    $alreadyReviewed = \App\Models\Review::where('user_id', Auth::id())
        ->where('product_id', $product->id)
        ->exists();

    // Cek apakah user punya order dengan status Diterima untuk produk ini
    $orders = \App\Models\Order::where('user_id', Auth::id())
        ->whereHas('orderItems', function($q) use ($product) {
            $q->where('product_id', $product->id);
        })
        ->where('status', 'Diterima')
        ->exists();

    return view('detail', [
        'product' => $product,
        'products' => \App\Models\Product::all()->except($product->id),
        'categories' => \App\Models\Category::all(),
        'reviews' => \App\Models\Review::where('product_id', $product->id)->get(),
        'orders' => $orders,
        'alreadyReviewed' => $alreadyReviewed,
    ]);
});

    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/privacy', fn() => view('privacy'));
    Route::get('/profil', function () {
        return view('profil', [
            'user' => Auth::user(),
            'users' => User::all()
        ]);
    });

    Route::post('/reviews/{product}', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');

    Route::get('/search', [ProductController::class, 'search'])->name('search');
    Route::get('/search/kategori={category:slug}', function (Category $category) {
        $products = Product::where('category_id', $category->id)->get();
        return view('search', [
            'products' => $products,
            'categories' => Category::all(),
            'category' => $category,
            'query' => $category->name
        ]);
    });

    Route::post('/profile/update/photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');

Route::post('/cart/add', [CartController::class, 'addAjax'])->name('cart.add.ajax');

Route::post('/orders/{order}/upload-screenshot', [OrderController::class, 'uploadScreenshot'])->name('orders.upload_screenshot');
    // Checkout & Order
    Route::get('/transaksi', [OrderController::class, 'showCheckoutForm'])->name('checkout.form');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/status/{order}', fn(Order $order) => view('status', ['order' => $order]))->name('status.order');
    Route::get('/term', fn() => view('term'));


    Route::post('/profile/update/ajax', [ProfileController::class, 'updateAjax'])->name('profile.update.ajax');

    Route::get('/status', [OrderController::class, 'showStatus'])->name('status.order');

    // Logout POST
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/index_guest');
    })->name('logout');

    // Group khusus untuk dashboard / admin panel (hanya admin yang bisa mengakses)
    Route::middleware('role:admin')->group(function () {

        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

        // Dashboard Home
        Route::get('/dashboard/', [DashboardController::class, 'index'])->name('dashboard.index');

        // Orders
        Route::get('/dashboard/orders', function () {
            return view('dashboard.orders', [
                'orders' => Order::with('product')->get()
            ]);
        });

        Route::put('/dashboard/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/dashboard/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Order::with('product')->get();

        // Store (Product Management)
        Route::get('/dashboard/store', function () {
            return view('dashboard/store', [
                'categories' => Category::all(),
                'products' => Product::all()
            ]);
        });
        Route::get('/dashboard/store/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/dashboard/store', [ProductController::class, 'store'])->name('dashboard.store');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Users
        Route::get('/dashboard/users', function () {
            return view('dashboard/users', [
                'users' => User::all(),
                'user' => Auth::user(),
            ]);
        });

        Route::put('/dashboard/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/dashboard/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/dashboard/users', [UserController::class, 'store'])->name('users.store');
        // (tambahkan route user edit/update/delete jika ada)
        // Contoh:
        // Route::put('/dashboard/users/{id}', [UserController::class, 'update'])->name('users.update');
        // Route::delete('/dashboard/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::resource('dashboard/categories', CategoryController::class)->except(['show', 'create']);
    });

});

// Guest routes
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
    });
});