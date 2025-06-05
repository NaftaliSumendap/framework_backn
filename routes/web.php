<?php

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController; // Tambahkan ini

Route::middleware('auth')->group(function () {

    // Halaman umum yang bisa diakses admin dan user
    Route::post('/profile/update-ajax', [UserController::class, 'updateField'])->name('profile.update.ajax');

    Route::get('/', function () {
        return view('index', ['categories' => Category::all(), 'products' => Product::all()]);
    })->name('index');

    Route::get('/about-us', function () {
        return view('about-us');
    });

    Route::get('/detail/{product:slug}', function (Product $product) {
        return view('detail', ['product' => $product, 'products' => Product::all()->except($product->id), 'categories' => Category::all(), 'reviews' => Review::where('product_id', $product->id)->get()]); 
    });

    Route::get('/chat', function () {
        return view('chat');
    });
    
    Route::get('/cart', function (Cart $cart) {
        $user_id = Auth::id();
        return view('cart', ['cart' => $cart, 'carts' => Cart::with('product') -> where('user_id', $user_id)->get(), 'products' => Product::all(), 'categories' => Category::all()]);
    })->name('cart.index'); // Pastikan ada name untuk rute cart

    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/privacy', function () {
        return view('privacy');
    });

    Route::get('/profil', function () {
        $user = Auth::user();
        $users = User::all();
        return view('profil', ['user' => $user, 'users' => $users]);
    });

    Route::get('/search', function () {
        return view('search');
    });

    Route::get('/search/kategori={category:slug}', function (Category $category) {
        $products = Product::where('category_id', $category->id)->get();
        return view('search', ['products' => $products, 'categories' => Category::all(), 'category' => $category]);
    });

    // Rute untuk halaman transaksi (checkout form)
    Route::get('/transaksi', [OrderController::class, 'showCheckoutForm'])->name('checkout.form');
    // Rute untuk memproses pesanan
    Route::post('/transaksi/process', [OrderController::class, 'processOrder'])->name('checkout.process');

    // Rute untuk halaman status pesanan (akan diperbarui nanti)
    Route::get('/status/{order}', function (Order $order) { // Tambahkan Route Model Binding untuk Order
        return view('status', ['order' => $order]);
    })->name('status.order');


    Route::get('/term', function () {
        return view('term');
    });

    Route::get('/logout', [Authentication::class, 'logout']);

    // Group khusus untuk dashboard / admin panel (hanya admin yang bisa mengakses)
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard/dashboard');
        });

        Route::get('/dashboard/orders', function () {
            return view('dashboard/orders');
        });

        Route::get('/dashboard/store', function () {
            return view('dashboard/store', ['categories' => Category::all(), 'products' => Product::all()]);
        });

        Route::get('/dashboard/users', function () {
            return view('dashboard/users', ['users' => User::all()]);
        });
    });

});


Route::middleware('guest')->group(function(){

    Route::get('/sign-in',[Authentication::class, 'login'])->name('login');
    Route::post('/sign-in',[Authentication::class, 'autentikasi']);
    Route::get('/sign-up', [Authentication::class, 'register'])->name('register');
    Route::post('/sign-up', [Authentication::class, 'createuser']);

    Route::get('/auth-google-redirect',[Authentication::class, 'google_redirect']);
    Route::get('/auth-google-callback',[Authentication::class, 'google_callback']);
    
    Route::get('/index_guest', function () {
        return view('index_guest', ['categories' => Category::all(), 'products' => Product::all()]);
    });
            
});
