<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Review;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;


Route::middleware('auth')->group(function () {

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
        // Ambil cart berdasarkan user yang sedang login
        $user_id = Auth::id(); // Ambil ID user yang sedang login
        return view('cart', ['cart' => $cart, 'carts' => Cart::with('product') -> where('user_id', $user_id)->get(), 'products' => Product::all(), 'categories' => Category::all()]);
    });
    
    
    Route::get('/privacy', function () {
        return view('privacy');
    });
    
    // Route::get('/profil', function () {
        //     return view('profil', ['user' => $user, 'users' => User::all()]);
        // });
        
        Route::get('/profil', function () {
            $user = Auth::user(); // Ambil user yang sedang login
            $users = User::all(); // Ambil semua user (misal untuk daftar)
            
            return view('profil', ['user' => $user, 'users' => $users]);
        });
        
        Route::get('/search', function () {
            return view('search');
        });
        
        // Route::get('/sign-in', function () {
            //     return view('sign-in');
            // });
            
           
            
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
            Route::get('/logout', [Authentication::class, 'logout']);

});


Route::middleware('guest')->group(function(){

    Route::get('/sign-in',[Authentication::class, 'login'])->name('login');
    Route::post('/sign-in',[Authentication::class, 'autentikasi']);
    Route::get('/sign-up', [Authentication::class, 'register'])->name('register');
    Route::post('/sign-up', [Authentication::class, 'createuser']);

    Route::get('/auth-google-redirect',[Authentication::class, 'google_redirect']);
    Route::get('/auth-google-callback',[Authentication::class, 'google_callback']);
    

    // Route::get('/sign-up', function () {
    // return view('sign-up');
    // });

    Route::get('/index_guest', function () {
    return view('index_guest', ['categories' => Category::all(), 'products' => Product::all()]);
    });
            
});
        