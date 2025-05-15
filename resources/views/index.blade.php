<x-layout>
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
              <img src="img/{{$product['image_path']}}" alt="Produk" class="w-full h-full object-cover rounded">
          </div>
          <!-- Konten Produk -->
          <p class="mt-2 text-sm font-medium line-clamp-2">{{$product['name']}}</p>

          <p class="text-red-600 font-bold text-sm mt-1">Rp. {{number_format($product['discount_price'], 0, ',', '.')}}</p>
          <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
              <span class="text-yellow-500">★ 4.6 | 20 Terjual</span>
          </div>
          </a>
          <!-- Tombol Tambahkan tetap di luar <a> -->
          <button class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
          <a href="/cart/{{$product['slug']}}">Tambahkan</a>
          </button>
      </div>
      @endforeach
      </div>
    </div>
  </div>
</x-layout>