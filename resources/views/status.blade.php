<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Status Pengiriman</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <style>
    .step-active {
      color: #f59e0b;
      font-weight: 600;
    }

    .step-completed {
      color: #10b981;
      font-weight: 600;
    }

    .step-icon-active {
      background-color: #f59e0b;
      color: white;
    }

    .step-icon-completed {
      background-color: #10b981;
      color: white;
    }
  </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

  <!-- Navbar User -->
  <x-navbar></x-navbar>

  <!-- Main Content -->
  <main class="flex-grow container mx-auto px-4 py-20 space-y-6">
    <!-- Tracking Order Section -->
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-2xl font-bold mb-6">Status Pengiriman</h2>
      <p class="text-gray-600 mb-6">No. Pesanan: #ORD-20240515-001</p>

      <!-- Tracking Steps -->
      <div class="relative">
        <!-- Progress Line -->
        <div class="absolute left-4 top-0 h-full w-1 bg-gray-200 -z-10"></div>
        <div class="absolute left-4 top-0 h-1/2 w-1 bg-amber-400 -z-10" id="progressBar"></div>

        <!-- Steps -->
        <div class="space-y-8">
          <!-- Step 1: Dikonfirmasi -->
          <div class="flex items-start step-completed" id="step1">
            <div
              class="flex-shrink-0 w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white mr-4 step-icon-completed">
              <i class="fas fa-check"></i>
            </div>
            <div>
              <h3 class="font-semibold">Dikonfirmasi</h3>
              <p class="text-gray-500 text-sm">Pesanan Anda telah dikonfirmasi</p>
              <p class="text-gray-400 text-xs mt-1">15 Mei 2024, 10:30 WIB</p>
            </div>
          </div>

          <!-- Step 2: Packaging -->
          <div class="flex items-start step-active" id="step2">
            <div
              class="flex-shrink-0 w-8 h-8 rounded-full bg-amber-400 flex items-center justify-center text-white mr-4 step-icon-active">
              <i class="fas fa-box"></i>
            </div>
            <div>
              <h3 class="font-semibold">Packaging</h3>
              <p class="text-gray-500 text-sm">Pesanan sedang dipersiapkan</p>
              <p class="text-gray-400 text-xs mt-1">15 Mei 2024, 12:45 WIB</p>
            </div>
          </div>

          <!-- Step 3: Pengantaran -->
          <div class="flex items-start" id="step3">
            <div
              class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 mr-4">
              <i class="fas fa-truck"></i>
            </div>
            <div>
              <h3 class="font-semibold text-gray-400">Pengantaran</h3>
              <p class="text-gray-400 text-sm">Menunggu proses pengantaran</p>
            </div>
          </div>

          <!-- Step 4: Diterima -->
          <div class="flex items-start" id="step4">
            <div
              class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 mr-4">
              <i class="fas fa-home"></i>
            </div>
            <div>
              <h3 class="font-semibold text-gray-400">Diterima</h3>
              <p class="text-gray-400 text-sm">Pesanan akan dicatat saat diterima</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Delivery Info -->
      <div class="mt-8 border-t pt-6">
        <h3 class="font-semibold mb-4">Informasi Pengiriman</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <p class="text-gray-600">Kurir</p>
            <p class="font-medium">JNE REG</p>
          </div>
          <div>
            <p class="text-gray-600">No. Resi</p>
            <p class="font-medium">JNE000123456789</p>
          </div>
          <div>
            <p class="text-gray-600">Estimasi Sampai</p>
            <p class="font-medium">18 Mei 2024</p>
          </div>
          <div>
            <p class="text-gray-600">Alamat Pengiriman</p>
            <p class="font-medium">Jl. Melodi No. 123, Jakarta Selatan</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Order Details -->
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-2xl font-bold mb-6">Detail Pesanan</h2>

      <!-- Product List -->
      <div class="space-y-4">
        <!-- Product 1 -->
        <div class="flex items-start justify-between border-b pb-4">
          <div class="flex items-start">
            <img src="img/gitar.jpg" alt="Gitar" class="w-16 h-16 object-cover rounded mr-4" />
            <div>
              <h3 class="font-semibold">Gitar Akustik Yamaha C40</h3>
              <p class="text-gray-500 text-sm">1 x Rp1.500.000</p>
            </div>
          </div>
          <p class="font-bold">Rp1.500.000</p>
        </div>

        <!-- Product 2 -->
        <div class="flex items-start justify-between border-b pb-4">
          <div class="flex items-start">
            <img src="img/gitar2.jpg" alt="gitar" class="w-16 h-16 object-cover rounded mr-4" />
            <div>
              <h3 class="font-semibold">Gitar Akustik</h3>
              <p class="text-gray-500 text-sm">1 x Rp1.500.000</p>
            </div>
          </div>
          <p class="font-bold">Rp1.500.000</p>
        </div>
      </div>

      <!-- Order Summary -->
      <div class="mt-6 space-y-3">
        <div class="flex justify-between">
          <span class="text-gray-600">Subtotal</span>
          <span>Rp3.000.000</span>
        </div>
        <div class="flex justify-between font-bold text-lg mt-4">
          <span>Total Pembayaran</span>
          <span class="text-amber-400">Rp3.000.000</span>
        </div>
      </div>

      <!-- Payment Info -->
      <div class="mt-6 border-t pt-6">
        <h3 class="font-semibold mb-4">Informasi Pembayaran</h3>
        <div class="flex justify-between">
          <span class="text-gray-600">Metode Pembayaran</span>
          <span>Transfer Bank BCA</span>
        </div>
        <div class="flex justify-between mt-2">
          <span class="text-gray-600">Status Pembayaran</span>
          <span class="text-green-500 font-semibold">Lunas</span>
        </div>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-4 mt-6">
      <button class="bg-white border border-gray-300 text-gray-700 py-2 px-6 rounded-lg hover:bg-gray-50 transition">
        <a href="/chat">
          <i class="fas fa-question-circle mr-2"></i>Butuh Bantuan?
        </a>
      </button>
      <button class="bg-amber-400 text-white py-2 px-6 rounded-lg hover:bg-amber-500 transition">
        <a href="/">
          <i class="fas fa-home mr-2"></i>Kembali ke Beranda
        </a>
      </button>
    </div>
  </main>
</body>
<!-- Footer -->
<x-footer></x-footer>
<script>
    // Update progress bar based on current step
    document.addEventListener('DOMContentLoaded', function () {
      // In a real app, you would get the current step from your backend
      const currentStep = 2; // 1: Dikonfirmasi, 2: Packaging, 3: Pengantaran, 4: Diterima

      // Update progress bar height
      const progressBar = document.getElementById('progressBar');
      if (currentStep >= 2) {
        progressBar.style.height = '50%'; // Halfway for step 2 (Packaging)
      } else if (currentStep >= 3) {
        progressBar.style.height = '75%'; // Three quarters for step 3 (Pengantaran)
      } else if (currentStep >= 4) {
        progressBar.style.height = '100%'; // Full for step 4 (Diterima)
      }

      // Highlight current step
      for (let i = 1; i <= 4; i++) {
        const step = document.getElementById(`step${i}`);
        if (i < currentStep) {
          step.classList.add('step-completed');
          step.querySelector('div:first-child').classList.add('step-icon-completed');
        } else if (i === currentStep) {
          step.classList.add('step-active');
          step.querySelector('div:first-child').classList.add('step-icon-active');
        }
      }
    });
  </script>
</html>