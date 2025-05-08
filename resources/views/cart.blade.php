<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Keranjang Belanja</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar User -->
    <x-navbar></x-navbar>

  <!-- Daftar Produk -->
  <main class="flex-grow container mx-auto px-4 py-8 space-y-4">
    <h2 class="text-2xl font-bold mb-4">Keranjang Belanja</h2>

    <!-- Produk List -->
    <div class="space-y-4">
      <!-- Loop produk 3x -->
      <!-- Item -->
      <div class="bg-white p-4 rounded-lg shadow-md flex items-start justify-between">
        <div class="flex items-start">
          <input type="checkbox" class="mt-10 mr-4 w-5 h-5 border-gray-300" />
          <img src="img/gitar.jpg" alt="Gitar" class="w-24 h-24 object-cover rounded mr-4" />
          <div>
            <h3 class="text-lg font-semibold"></h3>
            <p class="text-sm text-gray-500">Stok: 10</p>
            <div class="flex items-center mt-3 space-x-2">
              <button class="text-gray-500 hover:text-red-500"><i class="far fa-trash-alt"></i></button>
              <button class="text-gray-500 hover:text-amber-400"><i class="far fa-heart"></i></button>
            </div>
          </div>
        </div>
        <div class="text-right">
          <div class="flex items-center justify-end mb-2">
            <button class="px-2 border rounded"><i class="fas fa-minus text-gray-400"></i></button>
            <input type="text" value="1" readonly class="w-10 text-center bg-transparent border-none" />
            <button class="px-2 border rounded"><i class="fas fa-plus text-gray-400"></i></button>
          </div>
          <p class="font-bold text-lg">Rp1.500.000</p>
        </div>
      </div>

      <!-- Duplikat item sebanyak 2 lagi -->
      <!-- Item 2 -->
      <div class="bg-white p-4 rounded-lg shadow-md flex items-start justify-between">
        <div class="flex items-start">
          <input type="checkbox" class="mt-10 mr-4 w-5 h-5 border-gray-300" />
          <img src="img/gitar.jpg" alt="Gitar" class="w-24 h-24 object-cover rounded mr-4" />
          <div>
            <h3 class="text-lg font-semibold">Gitar Akustik</h3>
            <p class="text-sm text-gray-500">Stok: 10</p>
            <div class="flex items-center mt-3 space-x-2">
              <button class="text-gray-500 hover:text-red-500"><i class="far fa-trash-alt"></i></button>
              <button class="text-gray-500 hover:text-amber-400"><i class="far fa-heart"></i></button>
            </div>
          </div>
        </div>
        <div class="text-right">
          <div class="flex items-center justify-end mb-2">
            <button class="px-2 border rounded"><i class="fas fa-minus text-gray-400"></i></button>
            <input type="text" value="1" readonly class="w-10 text-center bg-transparent border-none" />
            <button class="px-2 border rounded"><i class="fas fa-plus text-gray-400"></i></button>
          </div>
          <p class="font-bold text-lg">Rp1.500.000</p>
        </div>
      </div>

    <!-- Ringkasan Belanja -->
    <div class="bg-white mt-10 p-6 rounded-lg shadow-md w-full">
      <h2 class="text-xl font-bold mb-4">Ringkasan Belanja</h2>
      <div class="space-y-4">
        <div class="flex justify-between">
          <span class="text-gray-600">Total Harga</span>
          <span class="font-bold">Rp3.000.000</span>
        </div>
        <hr class="my-2" />
        <div class="flex justify-between">
          <span class="text-gray-600">Total Pembayaran</span>
          <span class="font-bold text-amber-400">Rp3.000.000</span>
        </div>
        <a href="/transaksi">
          <button class="w-full bg-amber-400 text-white py-3 rounded-lg shadow-md hover:bg-amber-500 transition duration-300 mt-4">
            Belanja Sekarang
          </button>
        </a>
      </div>
    </div>
  </main>
  </body>
  <!-- Bagian Footer -->
   <x-footer></x-footer>
</html>