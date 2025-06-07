<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Alat Musik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar User -->
  <x-navbar></x-navbar>

    <!-- Konten Utama -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-20">
        <h2 class="text-lg md:text-xl font-semibold mt-6 mb-4">
          Hasil pencarian untuk '<span class="text-red-500">{{ $query }}</span>'
        </h2>

        <div class="flex flex-wrap gap-2 mb-6">
            <button class="bg-amber-400 text-white px-4 py-1.5 text-sm rounded shadow">Terkait</button>
            <button class="bg-gray-100 hover:bg-gray-200 px-4 py-1.5 text-sm rounded">Terbaru</button>
            <button class="bg-gray-100 hover:bg-gray-200 px-4 py-1.5 text-sm rounded">Terlaris</button>
            <button class="bg-gray-100 hover:bg-gray-200 px-4 py-1.5 text-sm rounded">Harga</button>
        </div>
          
@if($products->isEmpty())
  <div class="text-center text-gray-500 py-10">
    Tidak ada produk ditemukan untuk pencarian <span class="text-red-500 font-semibold">{{ $query }}</span>.
  </div>
@else
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1">
      <!-- Produk Card -->
       @foreach ($products as $product)
        <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
          <!-- Link ke product.html -->
          <a href="/detail/{{$product['slug']}}">
          <div class="relative w-full h-64">
              <img src="../img/{{$product['image_path']}}" alt="Produk" class="w-full h-full object-cover rounded">
          </div>
          <!-- Konten Produk -->
          <p class="mt-2 text-sm font-medium line-clamp-2">{{$product['name']}}</p>

          <p class="text-red-600 font-bold text-sm mt-1">Rp{{number_format($product['discount_price'], 0, ',', '.')}}</p>
          <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
              <span class="text-yellow-500">★ 4.6 | {{$product['sold']}} Terjual</span>
          </div>
          </a>
          <!-- Tombol Tambahkan tetap di luar <a> -->
          <button class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
          <a href="/cart/{{$product['slug']}}">Tambahkan</a>
          </button>
        </div>
        @endforeach
      </div>
@endif

          <div class="flex justify-center mt-8 space-x-2">
            <button class="px-3 py-1 border rounded">←</button>
            <button class="px-3 py-1 border font-bold bg-gray-200">1</button>
            <button class="px-3 py-1 border">2</button>
            <button class="px-3 py-1 border">→</button>
          </div>
    </div>
</div>
      
</body>
<x-footer></x-footer>
</html>