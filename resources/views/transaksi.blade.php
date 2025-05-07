<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transaksi - SounDeal</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100">
    <!-- Navbar User -->
    <x-navbar></x-navbar>

    <!-- Konten -->
    <main class="pt-20 pb-12 px-4 md:px-10">
      <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
          Ringkasan Transaksi
        </h2>

        <!-- Informasi Transaksi -->
        <div class="mb-6 text-sm text-gray-600 space-y-1">
          <p><strong>Tanggal Pesanan:</strong> 10 April 2025</p>
          <p>
            <strong>Alamat Pengiriman:</strong> Jl. Melodi Indah No. 123,
            Jakarta Selatan, DKI Jakarta 12430
          </p>
          <p><strong>Estimasi Sampai:</strong> 16 April - 18 April 2025</p>
        </div>

        <!-- Daftar Produk -->
        <div class="space-y-6">
          <div
            class="flex items-center justify-between border-b border-t-2 pt-6 pb-6"
          >
            <div class="flex items-center space-x-4">
              <img
                src="img/gitar.jpg"
                alt="Gitar"
                class="w-20 h-20 object-cover rounded border"
              />
              <div>
                <h3 class="font-semibold text-gray-700">
                  Gitar Akustik Yamaha C40
                </h3>
                <p class="text-sm text-gray-500">Jumlah: 1</p>
              </div>
            </div>
            <p class="font-bold text-gray-800">Rp 1.500.000</p>
          </div>

          <div class="flex items-center justify-between border-b pb-4">
            <div class="flex items-center space-x-4">
              <img
                src="img/gitar.jpg"
                alt="Gitar"
                class="w-20 h-20 object-cover rounded border"
              />
              <div>
                <h3 class="font-semibold text-gray-700">
                  Gitar Akustik Yamaha C40
                </h3>
                <p class="text-sm text-gray-500">Jumlah: 1</p>
              </div>
            </div>
            <p class="font-bold text-gray-800">Rp 1.500.000</p>
          </div>

        <!-- Total -->
        <div class="flex justify-between items-center mt-6 border-t pt-4">
          <h4 class="text-lg font-semibold text-gray-700">Total Pembayaran</h4>
          <p class="text-xl font-bold text-amber-500">Rp 3.000.000</p>
        </div>

        <!-- Form Pembayaran -->
        <div class="mt-8">
          <h3 class="text-lg font-semibold mb-4 text-gray-800">
            Pilih Metode Pembayaran
          </h3>
          <form action="#" method="POST" class="space-y-4" id="paymentForm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <label class="flex items-center space-x-2">
                <input
                  type="radio"
                  name="metode"
                  value="bank"
                  class="accent-amber-400"
                  checked
                />
                <span>Transfer Bank</span>
              </label>
              <label class="flex items-center space-x-2">
                <input
                  type="radio"
                  name="metode"
                  value="cod"
                  class="accent-amber-400"
                />
                <span>Cash on Delivery (COD)</span>
              </label>
              <label class="flex items-center space-x-2">
                <input
                  type="radio"
                  name="metode"
                  value="gopay"
                  class="accent-amber-400"
                />
                <span>GoPay (via Midtrans)</span>
              </label>
              <label class="flex items-center space-x-2">
                <input
                  type="radio"
                  name="metode"
                  value="qris"
                  class="accent-amber-400"
                />
                <span>QRIS (via Midtrans)</span>
              </label>
              <label class="flex items-center space-x-2">
                <input
                  type="radio"
                  name="metode"
                  value="va_bca"
                  class="accent-amber-400"
                />
                <span>Virtual Account BCA (via Midtrans)</span>
              </label>
              <label class="flex items-center space-x-2">
                <input
                  type="radio"
                  name="metode"
                  value="va_bni"
                  class="accent-amber-400"
                />
                <span>Virtual Account BNI (via Midtrans)</span>
              </label>
            </div>
            <button
              type="button"
              onclick="processPayment()"
              class="w-full bg-amber-400 text-white py-2 rounded hover:bg-amber-500 transition"
            >
              Konfirmasi Pembayaran
            </button>
          </form>
        </div>
      </div>
    </main>
    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
      <div class="bg-white rounded-lg p-6 w-96 shadow-xl">
        <div class="text-center">
          <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mt-3">Transaksi Berhasil!</h3>
          <div class="mt-2">
            <p class="text-sm text-gray-500">
              Pembayaran Anda telah berhasil diproses. Detail transaksi telah dikirim ke email Anda.
            </p>
          </div>
          <div class="mt-4">
            <button
              type="button"
              onclick="closeSuccessModal()"
              class="w-full bg-amber-400 text-white py-2 rounded hover:bg-amber-500 transition"
            >
              Kembali ke Beranda
            </button>
          </div>
        </div>
      </div>
    </div>
  </body>
  <!-- Footer -->
  <x-footer></x-footer>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script>
      function processPayment() {
        // Here you would normally process the payment
        // For demo purposes, we'll just show the success modal
        document.getElementById('successModal').classList.remove('hidden');
        
        // Prevent form submission (since we're just demoing the modal)
        return false;
      }

      function closeSuccessModal() {
        document.getElementById('successModal').classList.add('hidden');
        // Redirect to home page or wherever you want
        window.location.href = "index.html";
      }

      // Prevent form submission when pressing enter
      document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        processPayment();
      });
    </script>
</html>