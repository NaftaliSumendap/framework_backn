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
    <div id="navbar-placeholder"></div>

    <!-- Konten Utama -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-20">
        <h2 class="text-lg md:text-xl font-semibold mt-6 mb-4">
            Hasil pencarian untuk '<span class="text-red-500">gitar</span>'
        </h2>

        <div class="flex flex-wrap gap-2 mb-6">
            <button class="bg-amber-400 text-white px-4 py-1.5 text-sm rounded shadow">Terkait</button>
            <button class="bg-gray-100 hover:bg-gray-200 px-4 py-1.5 text-sm rounded">Terbaru</button>
            <button class="bg-gray-100 hover:bg-gray-200 px-4 py-1.5 text-sm rounded">Terlaris</button>
            <button class="bg-gray-100 hover:bg-gray-200 px-4 py-1.5 text-sm rounded">Harga</button>
        </div>
          
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1">
            <!-- Produk Card -->
            <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
                <div class="relative w-full h-64">
                    <img src="img/gitar3.jpg" alt="Produk" class="w-full h-full object-cover rounded">
                </div>
                <!-- Konten Produk -->
                <p class="mt-2 text-sm font-medium line-clamp-2">Gitar Akustik Squire</p>
                <p class="text-red-600 font-bold text-sm mt-1">Rp 2.800.000</p>
                <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
                    <span class="text-yellow-500">★ 4.6 | 20 Terjual</span>
                </div>
                <button onclick = "window.location.href='/cart'"class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
                    Tambahkan
                </button>
            </div>

            <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
                <div class="relative w-full h-64">
                    <img src="img/gitar2.jpg" alt="Produk" class="w-full h-full object-cover rounded">
                </div>
                <!-- Konten Produk -->
                <p class="mt-2 text-sm font-medium line-clamp-2">Gitar Yamaha</p>
                <p class="text-red-600 font-bold text-sm mt-1">Rp 1.800.000</p>
                <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
                    <span class="text-yellow-500">★ 4.6 | 20 Terjual</span>
                </div>
                <button onclick = "window.location.href='/cart'"class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
                    Tambahkan
                </button>
            </div>
            
            <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
                <div class="relative w-full h-64">
                    <img src="img/gitar.jpg" alt="Produk" class="w-full h-full object-cover rounded">
                </div>
                <!-- Konten Produk -->
                <p class="mt-2 text-sm font-medium line-clamp-2">Gitar</p>
                <p class="text-red-600 font-bold text-sm mt-1">Rp 1.800.000</p>
                <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
                    <span class="text-yellow-500">★ 4.6 | 20 Terjual</span>
                </div>
                <button onclick = "window.location.href='/cart'"class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
                    Tambahkan
                </button>
            </div>

            <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
                <div class="relative w-full h-64">
                    <img src="img/gitarlistrik2.jpg" alt="Produk" class="w-full h-full object-cover rounded">
                </div>
                <!-- Konten Produk -->
                <p class="mt-2 text-sm font-medium line-clamp-2">Gitar Listrik</p>
                <p class="text-red-600 font-bold text-sm mt-1">Rp 3.800.000</p>
                <div class="flex flex-col mt-1 text-xs text-gray-500 space-y-0.5">
                    <span class="text-yellow-500">★ 4.6 | 20 Terjual</span>
                </div>
                <button onclick = "window.location.href='/cart'"class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
                    Tambahkan
                </button>
            </div>
        </div>

        <div class="flex justify-center mt-8 space-x-2">
            <button class="px-3 py-1 border rounded">←</button>
            <button class="px-3 py-1 border font-bold bg-gray-200">1</button>
            <button class="px-3 py-1 border">2</button>
            <button class="px-3 py-1 border">→</button>
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
  // Fungsi untuk memuat footer
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