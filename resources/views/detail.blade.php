<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
      rel="stylesheet"
    />
</head>
<body class="bg-gray-100">

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-sm">
        <div class="text-center">
          <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
            <i class="bx bx-check text-green-600 text-2xl"></i>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mt-3">Berhasil!</h3>
          <div class="mt-2">
            <p class="text-sm text-gray-500">Produk telah ditambahkan ke keranjang</p>
          </div>
          <div class="mt-4">
            <button id="closeSuccessModal" type="button" class="px-4 py-2 bg-amber-400 text-white rounded-lg hover:bg-amber-500">
              Tutup
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Review Modal -->
    <div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold">Buat Ulasan</h3>
          <button id="closeReviewModal" class="text-gray-500 hover:text-gray-700">
            <i class="bx bx-x text-2xl"></i>
          </button>
        </div>
        <form>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Rating</label>
            <div class="flex space-x-1">
              <i class="bx bxs-star text-2xl text-gray-300 hover:text-amber-400 cursor-pointer"></i>
              <i class="bx bxs-star text-2xl text-gray-300 hover:text-amber-400 cursor-pointer"></i>
              <i class="bx bxs-star text-2xl text-gray-300 hover:text-amber-400 cursor-pointer"></i>
              <i class="bx bxs-star text-2xl text-gray-300 hover:text-amber-400 cursor-pointer"></i>
              <i class="bx bxs-star text-2xl text-gray-300 hover:text-amber-400 cursor-pointer"></i>
            </div>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Judul Ulasan</label>
            <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400">
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Ulasan Anda</label>
            <textarea class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400" rows="4"></textarea>
          </div>
          <div class="flex justify-end space-x-3">
            <button type="button" id="cancelReview" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Batal</button>
            <button type="submit" class="px-4 py-2 bg-amber-400 text-white rounded-lg hover:bg-amber-500">Kirim Ulasan</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Navbar User -->
    <x-navbar></x-navbar>
  

    <!-- Main Container -->
    <div class="container mx-auto p-4 pt-12"> 
        <!-- Product Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col md:flex-row">
            <!-- Bagian Kiri: Gambar Produk -->
            <div class="w-full md:w-1/3">
                <img src="../img/{{$product['image_path']}}" alt="Product Image" class="w-full h-full object-cover">
            </div>

            <!-- Bagian Tengah: Informasi Produk dan Informasi Tambahan -->
            <div class="w-full md:w-1/3 p-6">
                <!-- Product Title -->
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{$product['name']}}</h1>
                <!-- Product Description -->
                <p class="text-gray-600 mb-6">
                  {{$product['description']}}
                </p>

                <!-- Product Price -->
                <div class="flex items-center mb-6">
                    <span class="text-2xl font-bold text-gray-800">{{$product['discount_price']}}</span>
                    <span class="text-sm text-gray-500 line-through ml-2">{{$product['price']}}</span>
                    <span class="text-sm text-green-600 ml-2">(25% off)</span>
                </div>

                <!-- Additional Information Section -->
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Informasi Tambahan</h2>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Spesifikasi Produk</h3>
                            <ul class="list-disc list-inside text-gray-600">
                                <li>Bahan: Kayu</li>
                                <li>Warna: Coklat</li>
                                <li>Tipe: Akustik</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div>
                  <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-700 pt-6">Ulasan</h3>
                    <button id="openReviewModal" class="flex items-center text-amber-400 hover:text-amber-500">
                      <i class="bx bx-edit mr-1"></i> Buat Ulasan
                    </button>
                  </div>
                  <div class="mt-4 space-y-4">
                    <div class="flex items-center space-x-2 group">
                      <img src="img/Naftali.jpg" alt="Profile" class="w-9 h-9 rounded-full object-cover border-2 border-gray-300 group-hover:border-amber-400 transition-colors duration-200" />
                      <span class="text-gray-800 font-medium">Naftali</span>
                    </div>
                    <div class="flex items-center">
                      <i class="bx bxs-star text-amber-400"></i>
                      <i class="bx bxs-star text-amber-400"></i>
                      <i class="bx bxs-star text-amber-400"></i>
                      <i class="bx bxs-star text-amber-400"></i>
                      <i class="bx bxs-star text-gray-300"></i>
                    </div>
                    <p class="text-gray-600">"Gitar ini sangat nyaman dimainkan dan suaranya luar biasa!"</p>
                  </div>
                </div>  

            </div>

            <!-- Bagian Kanan: Pembelian -->
            <div class="w-full md:w-1/3 p-6 bg-gray-50">
                <!-- Quantity Selector -->
                <div class="mb-6">
                    <label for="quantity" class="block text-gray-700 mb-2">Jumlah:</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400">
                    <!-- Peringatan -->
                    <p id="warning" class="text-red-600 text-sm mt-2 hidden">Minimal pembelian adalah 1.</p>
                </div>

                <!-- Stock Information -->
                <div class="mb-6">
                    <p class="text-gray-700">Stok Tersedia: <span class="font-bold">{{$product['stock']}}</span></p>
                </div>

                <!-- Dynamic Price -->
                <div class="mb-6">
                    <p class="text-gray-700">Total Harga: <span class="font-bold text-red-600">Rp 1.500.000</span></p>
                </div>

                <!-- Add to Cart Button -->
                <button id="addToCartBtn" class="w-full bg-amber-400 text-white py-3 rounded-lg hover:bg-amber-500 transition duration-300 mb-4">
                    Tambahkan ke Keranjang
                </button>

                <!-- Buy Now Button -->
                <button id="buyNowBtn" class="w-full bg-gray-0 border-2 border-amber-400 text-amber-400 py-3 rounded-lg hover:bg-gray-100 transition duration-300">
                    Beli Sekarang
                </button>
            </div>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-8">
      <h2 class="text-2xl font-bold text-gray-800 text-center pb-4">Produk lainnya</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1">
      <!-- Produk Card -->
      <div class="bg-white rounded shadow hover:shadow-md transition p-4 w-full">
          <!-- Link ke product.html -->
          <a href="detail.html">
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
          <button onclick = "window.location.href='cart.html'"class="mt-2 text-xs bg-amber-400 text-black px-5 py-2 rounded hover:bg-yellow-300">
          Tambahkan
          </button>
      </div>
      </div>
  </div>


    <!-- JavaScript untuk Validasi dan Menghitung Total Harga -->
    <script>
        const quantityInput = document.getElementById('quantity');
        const priceElement = document.querySelector('.text-amber-400');
        const warningElement = document.getElementById('warning');
        const basePrice = 1500000; // Harga dasar produk

        quantityInput.addEventListener('input', () => {
            const quantity = parseInt(quantityInput.value);

            // Validasi jumlah
            if (quantity < 1 || isNaN(quantity)) {
                quantityInput.value = 1; // Reset ke 1 jika nilai tidak valid
                warningElement.classList.remove('hidden'); // Tampilkan peringatan
            } else {
                warningElement.classList.add('hidden'); // Sembunyikan peringatan
            }

            // Hitung total harga
            const totalPrice = basePrice * quantity;
            priceElement.textContent = `Rp ${totalPrice.toLocaleString()}`;
        });

        // Validasi saat form submit (opsional)
        document.querySelector('form')?.addEventListener('submit', (e) => {
            const quantity = parseInt(quantityInput.value);
            if (quantity < 1 || isNaN(quantity)) {
                e.preventDefault(); // Hentikan pengiriman form
                alert('Minimal pembelian adalah 1.');
            }
        });

        // Success Modal functionality
        const successModal = document.getElementById('successModal');
        const addToCartBtn = document.getElementById('addToCartBtn');
        const closeSuccessModal = document.getElementById('closeSuccessModal');
        const buyNowBtn = document.getElementById('buyNowBtn');

        addToCartBtn.addEventListener('click', () => {
            successModal.classList.remove('hidden');
            
            // Auto close after 3 seconds
            setTimeout(() => {
                successModal.classList.add('hidden');
            }, 3000);
        });

        closeSuccessModal.addEventListener('click', () => {
            successModal.classList.add('hidden');
        });

        buyNowBtn.addEventListener('click', () => {
            window.location.href = 'transaksi.html';
        });

        // Review Modal functionality
        const reviewModal = document.getElementById('reviewModal');
        const openReviewBtn = document.getElementById('openReviewModal');
        const closeReviewBtn = document.getElementById('closeReviewModal');
        const cancelReviewBtn = document.getElementById('cancelReview');

        openReviewBtn.addEventListener('click', () => {
            reviewModal.classList.remove('hidden');
        });

        closeReviewBtn.addEventListener('click', () => {
            reviewModal.classList.add('hidden');
        });

        cancelReviewBtn.addEventListener('click', () => {
            reviewModal.classList.add('hidden');
        });

        // Star rating functionality
        const stars = document.querySelectorAll('.bx.bxs-star');
        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                // Reset all stars
                stars.forEach(s => s.classList.remove('text-amber-400'));
                stars.forEach(s => s.classList.add('text-gray-300'));
                
                // Fill stars up to clicked one
                for (let i = 0; i <= index; i++) {
                    stars[i].classList.remove('text-gray-300');
                    stars[i].classList.add('text-amber-400');
                }
            });
        });

        // Close modals when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === successModal) {
                successModal.classList.add('hidden');
            }
            if (e.target === reviewModal) {
                reviewModal.classList.add('hidden');
            }
        });
    </script>

  <!-- Footer -->
  <div id="footer-placeholder"></div>

<script>
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
</script>
</body>
 <!-- Bagian Footer -->
  <x-footer></x-footer>
</html>