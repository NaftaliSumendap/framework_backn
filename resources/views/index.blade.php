<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100">
    <!-- Navbar User -->
    <div id="navbar-placeholder"></div>

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
      <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6"
      >
        <a
          href="search.html?kategori=gitar"
          class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition"
        >
          <h3 class="text-lg font-semibold text-gray-800">Gitar</h3>
          <p class="mt-2 text-gray-600">
            Temukan berbagai jenis gitar akustik dan elektrik.
          </p>
        </a>

        <a
          href="search.html?kategori=piano"
          class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition"
        >
          <h3 class="text-lg font-semibold text-gray-800">Piano</h3>
          <p class="mt-2 text-gray-600">
            Piano klasik dan digital untuk semua kebutuhan musik Anda.
          </p>
        </a>

        <a
          href="search.html?kategori=drum"
          class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition"
        >
          <h3 class="text-lg font-semibold text-gray-800">Drum</h3>
          <p class="mt-2 text-gray-600">
            Drum set lengkap untuk studio dan panggung.
          </p>
        </a>

        <a
          href="search.html?kategori=tradisional"
          class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition"
        >
          <h3 class="text-lg font-semibold text-gray-800">
            Alat Musik Tradisional
          </h3>
          <p class="mt-2 text-gray-600">
            Alat musik tradisional dari berbagai daerah.
          </p>
        </a>
      </div>
    </div>

    <!-- Konten Utama -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-20">
      <h2 class="text-2xl font-bold text-gray-800 text-center pb-4">Produk Unggulan</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1">
      <!-- Produk Card -->
      <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
          <!-- Link ke product.html -->
          <a href="/detail">
          <div class="relative w-full h-64">
              <img src="img/gitar.jpg" alt="Produk" class="w-full h-full object-cover rounded">
          </div>
          <!-- Konten Produk -->
          <p class="mt-2 text-sm font-medium line-clamp-2">Gitar Yamaha</p>
          <p class="text-red-600 font-bold text-sm mt-1">Rp 1.800.000</p>
          <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
              <span class="text-yellow-500">★ 4.6 | 20 Terjual</span>
          </div>
          </a>
          <!-- Tombol Tambahkan tetap di luar <a> -->
          <button onclick = "window.location.href='/cart'"class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
          Tambahkan
          </button>
      </div>

      <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
          <!-- Link ke product.html -->
          <a href="/detail">
          <div class="relative w-full h-64">
              <img src="img/gitar2.jpg" alt="Produk" class="w-full h-full object-cover rounded">
          </div>
          <!-- Konten Produk -->
          <p class="mt-2 text-sm font-medium line-clamp-2">Gitar Akustik Yamaha</p>
          <p class="text-red-600 font-bold text-sm mt-1">Rp 2.500.000</p>
          <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
              <span class="text-yellow-500">★ 4.6 | 20 Terjual</span>
          </div>
          </a>
          <!-- Tombol Tambahkan tetap di luar <a> -->
          <button onclick = "window.location.href='/cart'"class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
          Tambahkan
          </button>
      </div>

      <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
          <!-- Link ke product.html -->
          <a href="detail.html">
          <div class="relative w-full h-64">
              <img src="img/GitarListrik.jpg" alt="Produk" class="w-full h-full object-cover rounded">
          </div>
          <!-- Konten Produk -->
          <p class="mt-2 text-sm font-medium line-clamp-2">Gitar Listrik Yamaha</p>
          <p class="text-red-600 font-bold text-sm mt-1">Rp 3.100.000</p>
          <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
              <span class="text-yellow-500">★ 4.6 | 20 Terjual</span>
          </div>
          </a>
          <!-- Tombol Tambahkan tetap di luar <a> -->
          <button onclick = "window.location.href='/cart'"class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
          Tambahkan
          </button>
      </div>

          <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
              <div class="relative w-full h-64">
                  <img src="img/piano.jpg" alt="Produk" class="w-full h-full object-cover rounded">
              </div>
              <!-- Konten Produk -->
              <p class="mt-2 text-sm font-medium line-clamp-2">Keyboard</p>
              <p class="text-red-600 font-bold text-sm mt-1">Rp 6.500.000</p>
              <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
                  <span class="text-yellow-500">★ 4.6 | 20 Terjual</span>
              </div>
              <button onclick = "window.location.href='/cart'"class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
                  Tambahkan
              </button>
          </div>

          <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
            <div class="relative w-full h-64">
                <img src="img/piano2.jpg" alt="Produk" class="w-full h-full object-cover rounded">
            </div>
            <!-- Konten Produk -->
            <p class="mt-2 text-sm font-medium line-clamp-2">Keyboard Donner</p>
            <p class="text-red-600 font-bold text-sm mt-1">Rp 9.500.000</p>
            <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
                <span class="text-yellow-500">★ 4.6 | 20 Terjual</span>
            </div>
            <button onclick = "window.location.href='/cart'"class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
                Tambahkan
            </button>
        </div>

        <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
          <div class="relative w-full h-64">
              <img src="img/drum2.jpg" alt="Produk" class="w-full h-full object-cover rounded">
          </div>
          <!-- Konten Produk -->
          <p class="mt-2 text-sm font-medium line-clamp-2">Drum set Pearl</p>
          <p class="text-red-600 font-bold text-sm mt-1">Rp 13.500.000</p>
          <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
              <span class="text-yellow-500">★ 4.6 | 20 Terjual</span>
          </div>
          <button onclick = "window.location.href='/cart'"class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
              Tambahkan
          </button>
      </div>

      <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
        <div class="relative w-full h-64">
            <img src="img/GitarListrik.jpg" alt="Produk" class="w-full h-full object-cover rounded">
        </div>
        <!-- Konten Produk -->
        <p class="mt-2 text-sm font-medium line-clamp-2">Gitar Listrik</p>
        <p class="text-red-600 font-bold text-sm mt-1">Rp 7.500.000</p>
        <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
            <span class="text-yellow-500">★ 4.6 | 20 Terjual</span>
        </div>
        <button class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
            Tambahkan
        </button>
    </div>
      
          <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
              <div class="relative w-full h-64">
                  <img src="img/drum.jpg" alt="Produk" class="w-full h-full object-cover rounded">
              </div>
              <!-- Konten Produk -->
              <p class="mt-2 text-sm font-medium line-clamp-2">Drum set</p>
              <p class="text-red-600 font-bold text-sm mt-1">Rp 7.600.000</p>
              <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
                  <span class="text-yellow-500">★ 4.6 | 20 Terjual</span>
              </div>
              <button onclick = "window.location.href='/cart'"class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
                  Tambahkan
              </button>
          </div>
      </div>
  </div>

  <!-- Footer -->
  <div id="footer-placeholder"></div>

    <script>
      fetch("html/navbar.html")
        .then((res) => res.text())
        .then((data) => {
          const navbarDiv = document.getElementById("navbar-placeholder");
          navbarDiv.innerHTML = data;

          // Setelah navbar dimuat, jalankan fungsi toggle
          attachNavbarEvents();
        });

      function attachNavbarEvents() {
        const toggleBtn = document.getElementById("toggleMenu");
        const mobileMenu = document.getElementById("mobileMenu");

        if (toggleBtn && mobileMenu) {
          toggleBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
          });
        } else {
          console.warn("Element toggleMenu atau mobileMenu tidak ditemukan");
        }
      }
      
        // Footeer
  function loadFooter() {
    fetch('html/footer.html')
      .then(response => response.text())
      .then(data => {
        document.getElementById('footer-placeholder').innerHTML = data;
      })
      .catch(error => {
        console.error('Error loading footer:', error);
        document.getElementById('footer-placeholder').innerHTML = `
          <footer class="bg-slate-800 text-white text-center p-4">
            <p>© ${new Date().getFullYear()} Toko Alat Musik</p>
          </footer>
        `;
      });
  }

  // Panggil fungsi saat halaman selesai dimuat
  document.addEventListener('DOMContentLoaded', loadFooter);
    </script>
  </body>
</html>