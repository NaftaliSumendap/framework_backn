<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                  <img src="../img/SounDeal.svg" alt="SounDeal Logo" class="h-16">
                </div>
                <div class="flex-1 mx-4 max-w-lg">
                    <div class="relative">
                        <input type="text" placeholder="Cari alat musik..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400" />
                        <button class="absolute right-0 top-0 mt-2 mr-3 text-gray-500 hover:text-amber-400">
                          <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"/></svg>
                      </button>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                  <a href="/sign-in" class="text-gray-800 hover:text-amber-400">Masuk</a>
                  <a href="/sign-up" class="text-gray-800 hover:text-amber-400">Daftar</a>
                </div>
            </div>
        </div>
      </nav>
    <!-- Pajangan Utama -->
    <div class="pt-16">
      <!-- Hero Section -->
      <div class="container mx-auto px-6 py-8">
        <div class="bg-amber-400 rounded-lg p-8 text-white">
          <h1 class="text-4xl font-bold text-center">
            Selamat Datang di Toko Alat Musik
          </h1>
          <p class="mt-4 text-center">
            Temukan alat musik terbaik dengan harga terbaik hanya di sini.
          </p>
          <div class="flex justify-center mt-6">
            <button
            onclick="document.getElementById('produk-unggulan').scrollIntoView({ behavior: 'smooth' })"
            class="px-6 py-2 bg-white text-amber-500 rounded-lg hover:bg-gray-100"
          >
            Jelajahi Sekarang
          </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Product Categories -->
    <div class="container mx-auto px-6 py-8">
      <h2 class="text-2xl font-bold text-gray-800 text-center">
        Kategori Alat Musik
      </h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
        @foreach ($categories as $category)
        <a href="/search/kategori={{$category['slug']}}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
          <h3 class="text-lg font-semibold text-gray-800">{{$category['name']}}</h3>
          <p class="mt-2 text-gray-600">
            {{$category['description']}}
          </p>
        </a>
        @endforeach
      </div>
    </div>

<!-- Konten Utama -->
<div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-20">
      <h2 class="text-2xl font-bold text-gray-800 text-center pb-4">Produk Unggulan</h2>
      
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1">
      <!-- Produk Card -->
      @foreach ($products as $product)
      <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
          <!-- Link ke product.html -->
          <a href="/detail/{{$product['slug']}}">
          <div class="relative w-full h-64">
              <img src="{{ asset('storage/products/' . $product['image_path']) }}" alt="Produk" class="w-full h-full object-cover rounded">
          </div>
          <!-- Konten Produk -->
          <p class="mt-2 text-sm font-medium line-clamp-2">{{$product['name']}}</p>
          <p class="text-red-600 font-bold text-sm mt-1">Rp{{number_format($product['discount_price'], 0, ',', '.')}}</p>
          <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
              <span class="text-yellow-500">★ {{ number_format($product->reviews->avg('rating'), 1) ?? '0.0' }} | {{$product['sold']}} Terjual</span>
          </div>
          </a>
          <!-- Tombol Tambahkan tetap di luar <a> -->
          <button onclick="showLoginModal()" class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
          Tambahkan
          </button>
      </div>
      @endforeach
      </div>
    </div>

  <!-- Modal Login -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 max-w-sm w-full">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Login Required</h3>
        <button onclick="hideLoginModal()" class="text-gray-500 hover:text-gray-700">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      <p class="mb-4">Anda harus login terlebih dahulu untuk menambahkan produk ke keranjang.</p>
      <div class="flex justify-end space-x-3">
        <button onclick="hideLoginModal()" class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">
          Batal
        </button>
        <button onclick="window.location.href='/sign-up'" class="px-4 py-2 bg-amber-400 text-black rounded hover:bg-amber-500">
          Login / Daftar
        </button>
      </div>
    </div>
  </div>

  <x-footer></x-footer>
  </body>
</html>
  <script>
    // Fungsi untuk menampilkan modal
function showLoginModal() {
document.getElementById('loginModal').classList.remove('hidden');
}

// Fungsi untuk menyembunyikan modal
function hideLoginModal() {
document.getElementById('loginModal').classList.add('hidden');
}

// Tutup modal ketika klik di luar area modal
window.addEventListener('click', function(event) {
const modal = document.getElementById('loginModal');
if (event.target === modal) {
hideLoginModal();
}
});

</script>